<?php

namespace App\Filament\Resources\TermsAndConditions\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Schema;

class TermsAndConditionsForm
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
