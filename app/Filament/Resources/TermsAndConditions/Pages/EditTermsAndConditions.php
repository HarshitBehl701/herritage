<?php

namespace App\Filament\Resources\TermsAndConditions\Pages;

use App\Filament\Resources\TermsAndConditions\TermsAndConditionsResource;
use App\Models\Page;
use Filament\Resources\Pages\EditRecord;

class EditTermsAndConditions extends EditRecord
{
    protected static string $resource = TermsAndConditionsResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }


    public function getHeading(): string
    {
        return 'Edit Terms & Conditions';
    }

    public function getBreadcrumb(): string
    {
        return 'Terms & Conditions';
    }


    public function mount(string|int|null $record = null): void
    {
        $data = Page::firstOrCreate(
            [
                'slug' => 'terms-and-conditions'
            ],
            [
                'content' => []
            ]
        );

        parent::mount($data->getKey());
        $this->form->fill($data->toArray());
    }
}
