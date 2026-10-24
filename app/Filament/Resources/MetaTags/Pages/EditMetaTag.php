<?php

namespace App\Filament\Resources\MetaTags\Pages;

use App\Filament\Resources\MetaTags\MetaTagResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditMetaTag extends EditRecord
{
    protected static string $resource = MetaTagResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
