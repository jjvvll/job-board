<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Job;

class PruneSoftDeletedItems extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'prune:deleted-jobs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Permanently delete jobs';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $count = Job::onlyTrashed()->forceDelete();
        $this->info("Deleted {$count} soft-deleted jobs");
        return 0;
    }
}
