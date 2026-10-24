<?php

namespace App\Filament\Resources\Disclaimers\Pages;

use App\Filament\Resources\Disclaimers\DisclaimerResource;
use App\Models\Page;
use Filament\Resources\Pages\EditRecord;

class EditDisclaimer extends EditRecord
{
    protected static string $resource = DisclaimerResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    public function getHeading(): string
    {
        return 'Edit Disclaimer';
    }

    public function getBreadcrumb(): string
    {
        return 'Disclaimer';
    }

    public function mount(string|int|null $record = null): void
    {
        $data = Page::firstOrCreate(
            [
                'slug' => 'disclaimer'
            ],
            [
                'content' => []
            ]
        );

        parent::mount($data->getKey());
        $this->form->fill($data->toArray());
    }
}
