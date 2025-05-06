<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\JobApplication;
use Illuminate\Support\Facades\Log;


class PruneSoftDeletedApplication extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'prune:soft-deleted-application';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete all soft deleted applications';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $count = JobApplication::onlyTrashed()->forceDelete();
        $this->info("Deleted {$count} soft-deleted applications");
        return 0;
    }
}
