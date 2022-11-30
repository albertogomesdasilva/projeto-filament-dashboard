<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use App\Models\Task;
use App\Models\TaskGroup;
use Filament\Widgets\BarChartWidget;
use Illuminate\Foundation\Auth\User;

class UserssChart extends BarChartWidget {
    protected static ?string $heading = 'PRODUÇÃO';

    protected function getData(): array
    {
        $users = User::select('created_at')->get()->groupBy(function($users) {
            return Carbon::parse($users->created_at);
        });
        $quantities = [];

        foreach ($users as $user => $value) {
            array_push($quantities, $value->count());
        }
      
      
        $tasks = Task::select('title')->get()->groupBy(function($tasks) {
            return Carbon::parse($tasks->created_at);
        });

        $quantities2 = [];

        foreach ($tasks as $task => $value) {
            array_push($quantities2, $value->count());
        }
        $quantities3  = TaskGroup::count();

     
      

        return [

            'datasets' => [ 
                        [
                            'label' => 'PRODUÇÃO',
                            'data' => [$quantities3, $quantities, $quantities2],
                            'backgroundColor' => [ 'rgba(255, 205, 86)', ],
                            'borderColor' => ['rgba(255, 99, 132)' ],
                            'borderWidth' => 3
                        ],              
            ],

             'labels' => [ 'GRUPOS', 'USERS', 'TASKS'],
        ];
    }
}
