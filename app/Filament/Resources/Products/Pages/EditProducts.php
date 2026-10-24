<?php

namespace App\Filament\Resources\Products\Pages;

use App\Filament\Resources\Concerns\SwapsOrderOnUpdate;
use App\Filament\Resources\Products\ProductsResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditProducts extends EditRecord
{
    use SwapsOrderOnUpdate;

    protected static string $resource = ProductsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
