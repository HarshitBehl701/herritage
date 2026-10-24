<?php

namespace App\Filament\Resources\Disclaimers\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Schema;

class DisclaimerForm
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
