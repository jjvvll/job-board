<?php

use Illuminate\Support\Facades\Schedule;
// In bootstrap/schedule.php
Schedule::command('prune:deleted-jobs')->everyMinute();
Schedule::command('prune:soft-deleted-application')->everyMinute();
