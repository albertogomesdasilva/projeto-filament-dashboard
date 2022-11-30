<?php

namespace App\Filament\Widgets;

use App\Models\Task;
use App\Filament\Widgets\StatsOverview;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
 
    protected static ?string $pollingInterval = '1s';

    protected function getCards(): array
    {
        $tasks = Task::count();
        $h = date('H');
        $h = $h - 23;
        $hora = date($h. ':i:s');
        $date = date('d/m/y')  .  $hora;
        return [
             

            Card::make('Tasks Cadastradas', $tasks)
            ->description('32K increase')
            ->chart([7, 2, 10, 3, 15, 4, 17])
            ->descriptionIcon('heroicon-s-trending-up'),
            Card::make('Porcentagem', (100 / $tasks), '%')
            ->description('7% increase')
            ->descriptionIcon('heroicon-s-trending-down'),
            Card::make('Average time on page', $date)
            ->description('3% increase')
            ->descriptionIcon('heroicon-s-trending-up'),
        ];
    }
}
