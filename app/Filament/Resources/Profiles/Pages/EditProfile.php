<?php

namespace App\Filament\Resources\Profiles\Pages;

use App\Filament\Resources\Profiles\ProfileResource;
use App\Models\User;
use Filament\Resources\Pages\EditRecord;

class EditProfile extends EditRecord
{
    protected static string $resource = ProfileResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    public function mount(string|int|null $record = null): void
    {
        $data = User::firstOrFail();
        parent::mount($data->getKey());
        $this->form->fill($data->toArray());
    }
}
