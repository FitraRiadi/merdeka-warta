<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DeactivateExpiredAnnouncements extends Command
{
    protected $signature = 'announcements:deactivate-expired';

    protected $description = 'Delete announcements whose expired_at has passed';

    public function handle()
    {
        $count = \App\Models\Announcement::where('expired_at', '<=', now())->delete();

        $this->info("{$count} announcement(s) deleted.");
    }
}
