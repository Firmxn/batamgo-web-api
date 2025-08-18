<?php

namespace App\Filament\Widgets;

use App\Models\Bus;
use App\Models\Route;
use App\Models\Shelter;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;
    
    protected function getStats(): array
    {
        return [
            Stat::make('Total Rute', Route::count())
                ->description('Jumlah rute bus yang terdaftar')
                ->color('success'),
            Stat::make('Total Halte', Shelter::count())
                ->description('Jumlah halte yang tersedia')
                ->color('warning'),
            Stat::make('Total Bus', Bus::count())
                ->description('Jumlah bus yang beroperasi')
                ->color('danger'),
        ];
    }
}
