<?php

namespace App\Filament\Resources\MetaTags\Schemas;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Actions\Action;
use Illuminate\Support\Str;
use Filament\Forms\Components\Select;

class MetaTagForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('slug')
                    ->required()
                    ->columnSpanFull()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function ($state, callable $set) {
                        $set('slug', Str::slug($state));
                    })
                    ->suffixAction(
                        Action::make('selectEntity')
                            ->label('Pick')
                            ->icon('heroicon-o-magnifying-glass')
                            ->modalHeading('Select Entity')
                            ->modalSubmitActionLabel('Use Slug')
                            ->form([
                                Select::make('entity_type')
                                    ->label('Entity Type')
                                    ->options(config('modals_group_structure.slug_group'))
                                    ->reactive()
                                    ->afterStateUpdated(fn($set) => $set('entity_id', null))
                                    ->required(),

                                Select::make('entity_id')
                                    ->label('Entity')
                                    ->options(function (callable $get) {
                                        $type = $get('entity_type');

                                        if (!$type || !class_exists($type)) {
                                            return [];
                                        }

                                        return $type::pluck('slug', 'id')->toArray();
                                    })
                                    ->searchable()
                                    ->required(),
                            ])
                            ->action(function (array $data, callable $set) {

                                $type = $data['entity_type'] ?? null;
                                $id = $data['entity_id'] ?? null;

                                if (!$type || !$id)
                                    return;

                                $slug = $type::where('id', $id)->value('slug');

                                $set('slug', $slug);
                            })
                    ),

                Repeater::make('meta.tags')
                    ->label('Meta Tags')
                    ->schema([
                        TextInput::make('name')
                            ->label('Meta Name')->columnSpanFull()
                            ->placeholder('Name')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('value')
                            ->label('Meta Value')
                            ->placeholder('value')->columnSpanFull()
                            ->required()
                            ->maxLength(555),
                    ])
                    ->columns(2)
                    ->default([
                        [
                            'name' => 'title',
                            'value' => '',
                        ],
                        [
                            'name' => 'description',
                            'value' => '',
                        ],
                        [
                            'name' => 'keywords',
                            'value' => '',
                        ],
                    ])
                    ->columnSpanFull()
                    ->createItemButtonLabel('Add Meta Tag'),

                Repeater::make('meta.schema')
                    ->label('schema Tags')
                    ->schema([
                        Textarea::make('value')
                            ->label('schema Value')
                            ->placeholder('value')
                            ->autosize()
                            ->required()
                            ->columnSpanFull()
                            ->rule('json')
                    ])
                    ->columns(2)
                    ->columnSpanFull()
                    ->createItemButtonLabel('Add schema Tag'),
            ]);
    }
}
