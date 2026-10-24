<?php

namespace App\Filament\Resources\Keywords;

use App\Filament\Resources\Keywords\Pages\CreateKeyword;
use App\Filament\Resources\Keywords\Pages\EditKeyword;
use App\Filament\Resources\Keywords\Pages\ListKeywords;
use App\Models\Keywords;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class KeywordResource extends Resource
{
    protected static ?string $model = Keywords::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Tag;

    protected static ?string $navigationLabel = 'Keywords';

    protected static string|UnitEnum|null $navigationGroup = 'SEO';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('entity_type')
                ->label('Select Type')
                ->options(config('modals_group_structure.slug_group'))
                ->searchable()
                ->required()
                ->live(),

            Select::make('entity_id')
                ->label('Select Record')
                ->options(function (callable $get) {
                    $model = $get('entity_type');

                    if (!$model || !class_exists($model)) {
                        return [];
                    }

                    return $model::query()
                        ->get()
                        ->mapWithKeys(fn ($item) => [
                            $item->id => $item->title ?? $item->slug ?? 'ID: ' . $item->id,
                        ])
                        ->toArray();
                })
                ->searchable()
                ->required(),

            TagsInput::make('keywords')
                ->label('Keywords')
                ->placeholder('Add a keyword')
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('entity_type')
                    ->label('Type')
                    ->formatStateUsing(fn ($state) => class_basename($state))
                    ->sortable(),

                TextColumn::make('entity_id')
                    ->label('Record')
                    ->formatStateUsing(function ($state, $record) {
                        $model = $record->entity_type;

                        if (!$model || !class_exists($model)) {
                            return $state;
                        }

                        $item = $model::find($state);

                        return $item->title ?? $item->slug ?? 'ID: ' . $state;
                    }),

                TextColumn::make('keywords')
                    ->label('Keywords')
                    ->formatStateUsing(fn ($state) => is_array($state) ? count($state) . ' keywords' : '')
                    ->badge(),
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

    public static function getPages(): array
    {
        return [
            'index' => ListKeywords::route('/'),
            'create' => CreateKeyword::route('/create'),
            'edit' => EditKeyword::route('/{record}/edit'),
        ];
    }
}
