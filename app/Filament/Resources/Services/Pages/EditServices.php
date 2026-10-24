<?php

namespace App\Filament\Resources\Services\Pages;

use App\Filament\Resources\Concerns\SwapsOrderOnUpdate;
use App\Filament\Resources\Services\ServicesResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditServices extends EditRecord
{
    use SwapsOrderOnUpdate;

    protected static string $resource = ServicesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
