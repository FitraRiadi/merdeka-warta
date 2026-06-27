<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('super_admin');
    }

    public function index()
    {
        $authors = User::where('role', 'author')->paginate(10);
        return view('admin.users.index', compact('authors'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'sometimes|in:author,super_admin', // hanya super_admin bisa membuat super_admin lain? Kita batasi
        ]);

        // Selalu set role sebagai author, kecuali ada request khusus
        $validated['role'] = 'author';
        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        ActivityLog::log('CREATED', 'user', $user->id, "Menambahkan kontributor \"{$user->name}\" ({$user->email})");

        return redirect()->route('admin.users.index')
            ->with('success', 'Author berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        // Pastikan hanya author yang bisa diedit (bukan super_admin)
        if ($user->isSuperAdmin()) {
            abort(403, 'Tidak dapat mengedit super admin.');
        }
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        if ($user->isSuperAdmin()) {
            abort(403, 'Tidak dapat mengedit super admin.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        ActivityLog::log('UPDATED', 'user', $user->id, "Memperbarui kontributor \"{$user->name}\"");

        return redirect()->route('admin.users.index')
            ->with('success', 'Author berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        if ($user->isSuperAdmin()) {
            abort(403, 'Tidak dapat menghapus super admin.');
        }

        // Cek apakah user memiliki artikel, jika ada, set user_id menjadi null
        if ($user->articles()->count() > 0) {
            $user->articles()->update(['user_id' => null]);
        }

        $name = $user->name;
        $user->delete();

        ActivityLog::log('DELETED', 'user', null, "Menghapus kontributor \"{$name}\"");

        return redirect()->route('admin.users.index')
            ->with('success', 'Author berhasil dihapus.');
    }
}