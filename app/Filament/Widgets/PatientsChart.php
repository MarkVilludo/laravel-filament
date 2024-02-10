<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Patient;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class PatientsChart extends ChartWidget
{
    protected static ?string $heading = 'Patients';

    protected function getData(): array
    {
        $data = Trend::model(Patient::class)
                    ->between(
                        start: now()->subWeekday(),
                        end: now(),
                    )
                    ->perDay()
                    ->count();
 
        return [
            'datasets' => [
                [
                    'label' => 'Patients',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
