<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use App\Models\Task;
use Filament\Widgets\BarChartWidget;

class UsersChart extends BarChartWidget
{
    protected static ?string $heading = 'Tasks';

    protected function getData(): array
    {
        $tasks = Task::count();
        $taskss = Task::select('created_at')->get()->groupBy(function($taskss) {
            return Carbon::parse($taskss->created_at);
        });
        $quantitiess = [];

        foreach ($taskss as $task => $value) {
            array_push($quantitiess, $value->count());
        }
        return [
            'datasets' => [
                [
                    'label' => $tasks,
                    'data' => [0, 10, 5, 2, 21, 32, 45, 74, 65, 45, 77, 89],
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }
}
