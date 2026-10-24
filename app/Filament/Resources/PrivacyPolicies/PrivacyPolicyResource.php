<?php

namespace App\Filament\Resources\PrivacyPolicies;

use App\Filament\Resources\PrivacyPolicies\Pages\EditPrivacyPolicy;
use App\Filament\Resources\PrivacyPolicies\Schemas\PrivacyPolicyForm;
use App\Filament\Resources\PrivacyPolicies\Tables\PrivacyPoliciesTable;
use App\Models\Page;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class PrivacyPolicyResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ViewColumns;

    protected static ?string $navigationLabel = 'Privacy Policy';

    protected static string|UnitEnum|null $navigationGroup = 'Policies';

    public static function form(Schema $schema): Schema
    {
        return PrivacyPolicyForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PrivacyPoliciesTable::configure($table);
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
            'index' => EditPrivacyPolicy::route('/'),
        ];
    }
}
