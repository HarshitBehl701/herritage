<?php

namespace App\Filament\Resources\PrivacyPolicies\Pages;

use App\Filament\Resources\PrivacyPolicies\PrivacyPolicyResource;
use App\Models\Page;
use Filament\Resources\Pages\EditRecord;

class EditPrivacyPolicy extends EditRecord
{
    protected static string $resource = PrivacyPolicyResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }


    public function getHeading(): string
    {
        return 'Edit Privacy Policy';
    }

    public function getBreadcrumb(): string
    {
        return 'Privacy Policy';
    }


    public function mount(string|int|null $record = null): void
    {
        $data = Page::firstOrCreate(
            [
                'slug' => 'privacy-policy'
            ],
            [
                'content' => []
            ]
        );

        parent::mount($data->getKey());
        $this->form->fill($data->toArray());
    }
}
