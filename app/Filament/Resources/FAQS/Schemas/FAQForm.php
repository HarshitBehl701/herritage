<?php

namespace App\Filament\Resources\FAQS\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;

class FAQForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('entity_type')
                    ->label('Select Type')
                    ->options(config('modals_group_structure.slug_group'))
                    ->searchable()
                    ->required()
                    ->reactive(),

                Select::make('entity_id')
                    ->label('Select Record')
                    ->options(function (callable $get) {
                        $model = $get('entity_type');

                        if (!$model || !class_exists($model)) {
                            return [];
                        }

                        return $model::query()
                            ->get()
                            ->mapWithKeys(function ($item) {
                                return [
                                    $item->id => $item['title'] ?? $item->slug  ?? 'ID: ' . $item->id
                                ];
                            })
                            ->toArray();
                    })
                    ->searchable()
                    ->required(),

                Repeater::make('content')
                    ->label('FAQs')
                    ->schema([
                        TextInput::make('question')
                            ->required()
                            ->placeholder('Enter question'),
                        RichEditor::make('answer')
                            ->required()
                            ->placeholder('Enter answer'),
                    ])
                    ->columnSpanFull()
                    ->addActionLabel('Add FAQ')
                    ->reorderable(),
            ]);
    }
}
