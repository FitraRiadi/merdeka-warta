<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Poll;
use App\Models\RunningText;
use App\Models\PollVote;
use Illuminate\Http\Request;

class PollController extends Controller
{
    public function index()
    {
        $polls = Poll::with('options.votes')->active()->latest()->paginate(12);
        $runningTexts = RunningText::latest()->get();
        return view('public.polls', compact('polls', 'runningTexts'));
    }

    public function vote(Request $request, Poll $poll)
    {
        if (!$poll->is_active || ($poll->closes_at && $poll->closes_at->isPast())) {
            return response()->json(['success' => false, 'message' => 'Polling sudah ditutup.'], 403);
        }

        $ip = $request->ip();

        $request->validate([
            'option_ids' => 'required',
        ]);

        $optionIds = is_array($request->option_ids)
            ? $request->option_ids
            : [$request->option_ids];

        $existingVote = PollVote::where('poll_id', $poll->id)
            ->where('ip_address', $ip)
            ->exists();

        if ($existingVote) {
            return response()->json(['success' => false, 'message' => 'Kamu sudah voting.'], 429);
        }

        $validOptions = $poll->options()->pluck('id')->toArray();
        $validIds = array_intersect($optionIds, $validOptions);

        if (empty($validIds)) {
            return response()->json(['success' => false, 'message' => 'Opsi tidak valid.'], 422);
        }

        if ($poll->type === 'single') {
            $validIds = [reset($validIds)];
        }

        foreach ($validIds as $optionId) {
            PollVote::create([
                'poll_option_id' => $optionId,
                'poll_id' => $poll->id,
                'ip_address' => $ip,
            ]);
        }

        $results = $this->getResults($poll);

        return response()->json([
            'success' => true,
            'message' => 'Vote berhasil dikirim!',
            'results' => $results,
        ]);
    }

    public function results(Poll $poll)
    {
        $data = $this->getResults($poll);
        $ip = request()->ip();
        $data['has_voted'] = PollVote::where('poll_id', $poll->id)
            ->where('ip_address', $ip)
            ->exists();
        $data['voted_option_ids'] = PollVote::where('poll_id', $poll->id)
            ->where('ip_address', $ip)
            ->pluck('poll_option_id')
            ->toArray();
        return response()->json($data);
    }

    private function getResults(Poll $poll): array
    {
        $poll->load('options.votes');
        $totalVotes = $poll->votes()->count();
        $options = [];

        $correctOptionIds = $poll->mode === 'quiz'
            ? $poll->options()->where('is_correct', true)->pluck('id')->toArray()
            : [];

        $correctVotes = 0;
        foreach ($poll->options as $option) {
            $count = $option->votes->count();
            $options[] = [
                'id' => $option->id,
                'text' => $option->option_text,
                'count' => $count,
                'percentage' => $totalVotes > 0 ? round(($count / $totalVotes) * 100, 1) : 0,
                'is_correct' => $option->is_correct,
            ];
            if ($option->is_correct) {
                $correctVotes += $count;
            }
        }

        return [
            'mode' => $poll->mode,
            'total_votes' => $totalVotes,
            'correct_votes' => $correctVotes,
            'options' => $options,
        ];
    }
}
