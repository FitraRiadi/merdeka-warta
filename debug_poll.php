<?php
$poll = App\Models\Poll::with('options.votes')->first();
if (!$poll) {
    echo "No poll found!\n";
    exit;
}
echo "Poll: " . $poll->question . "\n";
echo "Mode: " . $poll->mode . "\n";
echo "Type: " . $poll->type . "\n";
echo "Options:\n";
foreach ($poll->options as $opt) {
    echo "  - " . $opt->option_text . " | correct: " . ($opt->is_correct ? 'yes' : 'no') . " | votes: " . $opt->votes->count() . "\n";
}

// Test the controller
$controller = new App\Http\Controllers\Public\PollController();
$response = $controller->results($poll);
echo "\nController response:\n";
print_r(json_decode($response->getContent(), true));
