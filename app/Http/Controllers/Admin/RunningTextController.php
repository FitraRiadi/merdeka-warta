<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\RunningText;
use Illuminate\Http\Request;

class RunningTextController extends Controller
{
    public function __construct()
    {
        $this->middleware('super_admin');
    }

    public function index()
    {
        $runningTexts = RunningText::latest()->paginate(10);
        return view('admin.running-texts.index', compact('runningTexts'));
    }

    public function create()
    {
        $count = RunningText::count();
        if ($count >= 4) {
            return redirect()->route('admin.running-texts.index')
                ->with('error', 'Maksimal 4 running text. Hapus salah satu terlebih dahulu.');
        }
        return view('admin.running-texts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'text' => 'required|string',
        ]);

        $count = RunningText::count();
        if ($count >= 4) {
            return redirect()->route('admin.running-texts.index')
                ->with('error', 'Maksimal 4 running text. Hapus salah satu terlebih dahulu.');
        }

        $rt = RunningText::create($validated);

        ActivityLog::log('CREATED', 'running_text', $rt->id, "Menambahkan running text");

        return redirect()->route('admin.running-texts.index')
            ->with('success', 'Running text berhasil ditambahkan.');
    }

    public function edit(RunningText $runningText)
    {
        return view('admin.running-texts.edit', compact('runningText'));
    }

    public function update(Request $request, RunningText $runningText)
    {
        $validated = $request->validate([
            'text' => 'required|string',
        ]);

        $runningText->update($validated);

        ActivityLog::log('UPDATED', 'running_text', $runningText->id, "Memperbarui running text");

        return redirect()->route('admin.running-texts.index')
            ->with('success', 'Running text berhasil diperbarui.');
    }

    public function destroy(RunningText $runningText)
    {
        $runningText->delete();

        ActivityLog::log('DELETED', 'running_text', null, "Menghapus running text");

        return redirect()->route('admin.running-texts.index')
            ->with('success', 'Running text berhasil dihapus.');
    }
}