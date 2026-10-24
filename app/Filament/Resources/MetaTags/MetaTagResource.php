<?php

namespace App\Filament\Resources\MetaTags;

use App\Filament\Resources\MetaTags\Pages\CreateMetaTag;
use App\Filament\Resources\MetaTags\Pages\EditMetaTag;
use App\Filament\Resources\MetaTags\Pages\ListMetaTags;
use App\Filament\Resources\MetaTags\Schemas\MetaTagForm;
use App\Filament\Resources\MetaTags\Tables\MetaTagsTable;
use App\Models\Meta;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class MetaTagResource extends Resource
{
    protected static ?string $model = Meta::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedTag;

    protected static ?string $navigationLabel = 'Meta Tags';

    protected static string|UnitEnum|null $navigationGroup = 'SEO';

    protected static ?int $navigationSort = 100;

    public static function form(Schema $schema): Schema
    {
        return MetaTagForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MetaTagsTable::configure($table);
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
            'index' => ListMetaTags::route('/'),
            'create' => CreateMetaTag::route('/create'),
            'edit' => EditMetaTag::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
