<?php

namespace App\Filament\Resources\MetaTags\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class MetaTagsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('meta.tags')
                    ->label('Meta Tags')
                    ->getStateUsing(function ($record) {
                        $tags = data_get($record->meta, 'tags', []);

                        return collect($tags)
                            ->filter(fn($tag) => isset($tag['name'], $tag['value']))
                            ->map(fn($tag) => "{$tag['name']}: {$tag['value']}")
                            ->join(', ');
                    })
                    ->wrap()
                    ->limit(120),
            ])
            ->filters([
                // TrashedFilter::make(),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
