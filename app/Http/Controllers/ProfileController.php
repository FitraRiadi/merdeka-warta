<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function updateSettings(Request $request): RedirectResponse
    {
        if (!$request->user()->isSuperAdmin()) {
            abort(403);
        }

        $keys = [
            'social_whatsapp', 'social_facebook', 'social_youtube', 'social_instagram',
            'contact_address', 'contact_phone', 'contact_email_primary', 'contact_email_secondary', 'contact_hours',
            'contributor_phone',
            'contributor_add_without_permission',
            'contributor_delete_without_permission',
            'contributor_edit_without_permission',
            'contributor_gallery_without_permission',
        ];

        foreach ($keys as $key) {
            if ($request->has($key)) {
                Setting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $request->input($key)]
                );
            }
        }

        return Redirect::route('profile.edit')->with('status', 'settings-updated');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $rules = [
            'password' => ['required', 'current_password'],
        ];

        if ($request->user()->isSuperAdmin()) {
            $rules['delete_pin'] = ['required', function ($attribute, $value, $fail) {
                if ($value !== '237634118') {
                    $fail('PIN penghapusan tidak sesuai.');
                }
            }];
        }

        $request->validateWithBag('userDeletion', $rules);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
