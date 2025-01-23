<?php

namespace App\Providers;

use App\Models\Ticket;
use App\Observers\TicketObserver;
use Illuminate\Support\ServiceProvider;
use Filament\Notifications\Livewire\DatabaseNotifications;

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
        //wajib ada utk buat obersve
        Ticket::observe(TicketObserver::class);

        //supaya dia tak realtime dan kena refresh baru dpt notify baru
        DatabaseNotifications::pollingInterval(null);
    }
}