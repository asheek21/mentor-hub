<?php

namespace App\Providers;

use App\Listeners\UserRegisteredDefaultRating;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

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
        /** @phpstan-ignore-next-line */
        Vite::macro('image', fn (string $asset) => $this->asset("resources/images/{$asset}"));

        Vite::prefetch(concurrency: 3);

        Event::listen(
            Registered::class,
            UserRegisteredDefaultRating::class,
        );
    }
}
