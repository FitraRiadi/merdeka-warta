<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Poll;
use App\Models\PollOption;
use Illuminate\Http\Request;

class PollController extends Controller
{
    public function __construct()
    {
        $this->middleware('super_admin');
    }

    public function index()
    {
        $polls = Poll::withCount('votes')->latest()->paginate(10);
        return view('admin.polls.index', compact('polls'));
    }

    public function create()
    {
        return view('admin.polls.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'type' => 'required|in:single,multiple',
            'mode' => 'required|in:biasa,quiz',
            'closes_at' => 'nullable|date|after:now',
            'options' => 'required|array|min:2',
            'options.*.text' => 'required|string|max:255',
            'options.*.is_correct' => 'boolean',
        ]);

        if ($validated['mode'] === 'quiz') {
            $hasCorrect = collect($validated['options'])->contains(fn($o) => ($o['is_correct'] ?? false));
            if (!$hasCorrect) {
                return back()->withErrors(['options' => 'Mode quiz harus memiliki minimal 1 opsi yang benar.'])->withInput();
            }
        }

        $poll = Poll::create([
            'question' => $validated['question'],
            'type' => $validated['type'],
            'mode' => $validated['mode'],
            'is_active' => true,
            'closes_at' => $validated['closes_at'] ?? null,
            'created_by' => auth()->id(),
        ]);

        foreach ($validated['options'] as $option) {
            $poll->options()->create([
                'option_text' => $option['text'],
                'is_correct' => $option['is_correct'] ?? false,
            ]);
        }

        ActivityLog::log('CREATED', 'poll', $poll->id, "Membuat polling: \"{$poll->question}\"");

        return redirect()->route('admin.polls.index')
            ->with('success', 'Polling berhasil dibuat.');
    }

    public function show(Poll $poll)
    {
        $poll->load(['options.votes', 'creator']);

        $totalVotes = $poll->votes()->count();
        $stats = [];

        foreach ($poll->options as $option) {
            $count = $option->votes->count();
            $stats[] = [
                'option' => $option,
                'count' => $count,
                'percentage' => $totalVotes > 0 ? round(($count / $totalVotes) * 100, 1) : 0,
            ];
        }

        $correctVotes = 0;
        if ($poll->mode === 'quiz' && $totalVotes > 0) {
            $correctOptionIds = $poll->options()->where('is_correct', true)->pluck('id');
            if ($correctOptionIds->isNotEmpty()) {
                $correctVotes = $poll->votes()
                    ->whereIn('poll_option_id', $correctOptionIds)
                    ->distinct('ip_address')
                    ->count('ip_address');
            }
        }

        return view('admin.polls.show', compact('poll', 'stats', 'totalVotes', 'correctVotes'));
    }

    public function destroy(Poll $poll)
    {
        $poll->delete();

        ActivityLog::log('DELETED', 'poll', null, "Menghapus polling");

        return redirect()->route('admin.polls.index')
            ->with('success', 'Polling berhasil dihapus.');
    }
}
