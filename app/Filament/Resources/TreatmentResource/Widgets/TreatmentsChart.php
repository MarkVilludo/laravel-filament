<?php

namespace App\Filament\Resources\TreatmentResource\Widgets;

use Filament\Widgets\ChartWidget;

class TreatmentsChart extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {
        return [
            //
        ];
    }

    protected function getType(): string
    {
        return 'bubble';
    }
}
