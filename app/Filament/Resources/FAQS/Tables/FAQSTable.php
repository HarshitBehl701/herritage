<?php

namespace App\Filament\Resources\FAQS\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class FAQSTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('entity_type')
                    ->label('Type')
                    ->formatStateUsing(fn($state) => class_basename($state))
                    ->searchable(),

                TextColumn::make('entity_id')
                    ->label('Record')
                    ->formatStateUsing(function ($state, $record) {

                        $model = $record->entity_type;

                        if (!$model || !class_exists($model)) {
                            return $state;
                        }

                        $item = $model::find($state);

                        if (!$item || !isset($item->content)) {
                            return 'ID: ' . $state;
                        }


                        return $item['title'] ?? 'ID: ' . $state;
                    })
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
