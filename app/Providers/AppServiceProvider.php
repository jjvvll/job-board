<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;

use Illuminate\Support\Facades\Event;
use App\Events\JobStatusUpdated as JobStatusUpdatedEvent;
use App\Listeners\JobStatusUpdated as JobStatusUpdatedListener;

use App\Events\NewApplication as NewApplicationEvent;
use App\Listeners\NewApplication as NewApplicationListener;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(
            JobStatusUpdatedEvent::class,
            [JobStatusUpdatedListener::class, 'handle']
        );

        Event::listen(
            NewApplicationEvent::class,
            [NewApplicationListener::class, 'handle']
        );
    }
}
