<?php

namespace App\Filament\Resources\Disclaimers;

use App\Filament\Resources\Disclaimers\Pages\EditDisclaimer;
use App\Filament\Resources\Disclaimers\Schemas\DisclaimerForm;
use App\Filament\Resources\Disclaimers\Tables\DisclaimersTable;
use App\Models\Page;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class DisclaimerResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ViewColumns;

    protected static ?string $navigationLabel = 'Disclaimer';

    protected static string|UnitEnum|null $navigationGroup = 'Policies';

    public static function form(Schema $schema): Schema
    {
        return DisclaimerForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DisclaimersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => EditDisclaimer::route('/'),
        ];
    }
}
