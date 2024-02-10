<?php

namespace App\Filament\Resources\TreatmentsResource\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Patient;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class TreatmentsChart extends ChartWidget
{
    protected static ?string $heading = 'Treatments';

    protected function getData(): array
    {
        $data = Trend::model(Patient::class)
        ->between(
            start: now()->subYear(),
            end: now(),
        )
        ->perMonth()
        ->count();
 
        return [
            'datasets' => [
                [
                    'label' => 'Treatments',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'polarArea';
    }
}
