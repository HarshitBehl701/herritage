<?php

namespace App\Filament\Resources\MetaTags\Pages;

use App\Filament\Resources\MetaTags\MetaTagResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMetaTags extends ListRecords
{
    protected static string $resource = MetaTagResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
