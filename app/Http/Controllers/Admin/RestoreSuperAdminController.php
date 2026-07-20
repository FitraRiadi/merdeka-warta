<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RestoreSuperAdminController extends Controller
{
    public function index()
    {
        $superAdmin1 = User::where('role', 'super_admin')
            ->where('is_hidden', false)
            ->exists();

        if ($superAdmin1) {
            return view('admin.restore.secured');
        }

        return view('admin.restore.restore');
    }

    public function restore(Request $request)
    {
        $superAdmin1 = User::where('role', 'super_admin')
            ->where('is_hidden', false)
            ->exists();

        if ($superAdmin1) {
            return redirect()->route('admin.restore.index')
                ->with('error', 'Super admin utama masih aktif.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'super_admin',
            'is_hidden' => false,
        ]);

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('status', 'Super admin berhasil dibuat. Silakan login.');
    }
}
