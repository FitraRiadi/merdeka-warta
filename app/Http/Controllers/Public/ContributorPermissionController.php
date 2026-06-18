<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\ContributorPermission;
use Illuminate\Http\Request;

class ContributorPermissionController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'class' => 'required|string|max:100',
            'reason' => 'required|string|max:1000',
            'phone' => 'required|string|max:20',
        ]);

        ContributorPermission::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Perizinan Dikirim',
            'subtitle' => 'Terima kasih! Permintaan Anda akan segera kami proses. Tim redaksi akan menghubungi Anda melalui WhatsApp untuk informasi lebih lanjut.',
        ]);
    }
}
