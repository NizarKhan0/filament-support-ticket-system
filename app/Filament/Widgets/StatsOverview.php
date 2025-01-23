<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use App\Models\Label;
use App\Models\Role;
use App\Models\Ticket;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    //function ini dari vendor filament widget, chstom (override)
    protected static ?int $sort = 1;
    protected function getStats(): array
    {
        return [
            Stat::make('Total Tickets', Ticket::count()),
            Stat::make('Total Agents', User::whereHas('roles', function ($query) {
                $query->where('title', Role::ROLES['Agent']);
            })->count()),
            Stat::make('Total Categories', Category::count()),
            Stat::make('Total Labels', Label::count()),
        ];
    }
}