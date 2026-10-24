<?php

namespace App\Filament\Resources\TermsAndConditions;

use App\Filament\Resources\TermsAndConditions\Pages\EditTermsAndConditions;
use App\Filament\Resources\TermsAndConditions\Schemas\TermsAndConditionsForm;
use App\Filament\Resources\TermsAndConditions\Tables\TermsAndConditionsTable;
use App\Models\Page;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TermsAndConditionsResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ViewColumns;

    protected static ?string $navigationLabel = 'Terms And Conditions';

    protected static string|\UnitEnum|null $navigationGroup = 'Policies';

    public static function form(Schema $schema): Schema
    {
        return TermsAndConditionsForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TermsAndConditionsTable::configure($table);
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
            'index' => EditTermsAndConditions::route('/')
        ];
    }
}
