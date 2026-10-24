<?php

namespace App\Filament\Resources\PrivacyPolicies\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Schema;

class PrivacyPolicyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
 
                RichEditor::make('content.description')
                    ->label('Description')->columnSpanFull()->required(),
            ]);
    }
}
