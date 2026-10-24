<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Schema;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return collect(config('modals_group_structure.slug_group', []))
            ->filter(function ($label, $model) {
                return class_exists($model)
                    && Schema::hasTable((new $model)->getTable());
            })
            ->map(function ($label, $model) {
                return Stat::make(
                    $label,
                    $model::count()
                )
                    ->description("Total {$label}")
                    ->color('info');
            })
            ->values()
            ->all();
    }
}