<?php

namespace App\Filament\Widgets;

use App\Models\Task;
use App\Models\User;
use App\Models\TaskGroup;
use App\Filament\Widgets\StatsOverview;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
 
    protected static ?string $pollingInterval = '1s';

    protected function getCards(): array
    {
        $users = User::count();
        
        $tasksgroup = TaskGroup::count();

        $tasks = Task::count();

        $h = date('H');
        $h = ($h -3);
        $hora = date($h. ':i:s');
        $date = date('d/m/y') .' | ' .  $hora;
        return [
             

            Card::make('Tarefas Cadastradas', $tasks)
            ->description('32K increase')
            ->chart([$users, $tasks, $tasksgroup])
            ->descriptionIcon('heroicon-s-trending-up'),
            Card::make('Usuários:', $users)
            ->description('7% increase')
            ->descriptionIcon('heroicon-s-trending-down'),
            Card::make('Average time on page', $date)
            ->description('3% increase')
            ->descriptionIcon('heroicon-s-trending-up'),
        ];
    }
}
