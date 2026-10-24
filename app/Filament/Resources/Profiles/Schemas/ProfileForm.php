<?php

namespace App\Filament\Resources\Profiles\Schemas;

use Filament\Forms\Components\{TextInput, Textarea, FileUpload, Repeater, Select, Placeholder};
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
use Intervention\Image\Format;
use Intervention\Image\Laravel\Facades\Image;

class ProfileForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            /*
            |--------------------------------------------------------------------------
            | Basic Information
            |--------------------------------------------------------------------------
            */
            Section::make('Account Information')
                ->columnSpanFull()
                ->schema([

                    TextInput::make('name')
                        ->required()
                        ->maxLength(255)
                        ->columnSpan(1),

                    TextInput::make('email')
                        ->email()
                        ->required()
                        ->columnSpan(1),

                    TextInput::make('password')
                        ->password()
                        ->revealable()
                        ->label('New Password')
                        ->dehydrated(fn($state) => filled($state))
                        ->dehydrateStateUsing(fn($state) => Hash::make($state))
                        ->extraInputAttributes([
                            'autocomplete' => 'new-password',
                            'onfocus' => 'this.removeAttribute("readonly")',
                            'data-form-type' => 'other',
                            'data-lpignore' => 'true',
                            'data-1p-ignore' => 'true',
                        ])
                        ->columnSpanFull(),
                ]),

            /*
            |--------------------------------------------------------------------------
            | Brand Information
            |--------------------------------------------------------------------------
            */
            Section::make('Brand Details')
                ->columnSpanFull()
                ->schema([

                    Textarea::make('additional_info.address')
                        ->label('Primary Address')
                        ->columnSpan(1),
                    TextInput::make('additional_info.gstin')
                        ->label('GSTIN')
                        ->columnSpan(1),


                    FileUpload::make('additional_info.brochure')
                        ->label('Brochure')
                        ->disk('public_root')
                        ->directory('brochure')
                        ->acceptedFileTypes(['application/pdf'])
                        ->maxSize(100 * 1024)
                        ->downloadable()
                        ->openable()
                        ->previewable(false)
                        ->preserveFilenames()
                        ->columnSpanFull(),
                ]),

            /*
            |--------------------------------------------------------------------------
            | Map / Iframe
            |--------------------------------------------------------------------------
            */
            Section::make('Map / Embed')
                ->columnSpanFull()
                ->schema([

                    TextInput::make('additional_info.iframe')
                        ->label('Iframe Embed Code')
                        ->live(),

                    Placeholder::make('iframe_preview')
                        ->label('Preview')
                        ->reactive()
                        ->visible(fn($get) => filled($get('additional_info.iframe')))
                        ->content(function ($get) {

                            $iframe = $get('additional_info.iframe');

                            if (!filled($iframe)) {
                                return 'No preview available';
                            }

                            return new HtmlString("
                                <div style='margin-top:10px;border:1px solid #e5e7eb;padding:12px;border-radius:10px;background:#fafafa'>
                                    {$iframe}
                                </div>
                            ");
                        }),
                ]),

            /*
            |--------------------------------------------------------------------------
            | Social Links
            |--------------------------------------------------------------------------
            */
            Section::make('Social Links')
                ->columnSpanFull()
                ->schema([
                    Repeater::make('additional_info.social_links')
                        ->schema([
                            Select::make('platform')
                                ->options([
                                    'facebook' => 'Facebook',
                                    'instagram' => 'Instagram',
                                    'linkedin' => 'LinkedIn',
                                    'twitter' => 'Twitter',
                                    'youtube' => 'YouTube',
                                ])
                                ->required(),

                            TextInput::make('url')
                                ->url()
                                ->required(),
                        ])
                        ->collapsible()
                        ->addActionLabel('Add Social Link'),
                ]),

            /*
            |--------------------------------------------------------------------------
            | Contact Information
            |--------------------------------------------------------------------------
            */
            Section::make('Contact Information')
                ->columnSpanFull()
                ->columns(3)
                ->schema([

                    Repeater::make('additional_info.mobile_numbers')
                        ->label('Mobile Numbers')
                        ->schema([
                            TextInput::make('Name'),
                            TextInput::make('number')
                                ->tel()
                                ->required(),
                        ])
                        ->collapsible()
                        ->columnSpanFull()
                    ,

                    Repeater::make('additional_info.emails')
                        ->label('Additional Emails')
                        ->schema([
                            TextInput::make('Name'),
                            TextInput::make('email')
                                ->email()
                                ->required(),
                        ])
                        ->collapsible()
                        ->columnSpanFull()
                    ,

                    Repeater::make('additional_info.addresses')
                        ->label('Other Addresses')
                        ->schema([
                            TextInput::make('Name'),
                            Textarea::make('address')
                                ->rows(2)
                                ->required(),
                        ])
                        ->collapsible()
                        ->columnSpanFull()
                    ,
                ]),

            /*
            |--------------------------------------------------------------------------
            | Branding
            |--------------------------------------------------------------------------
            */
            Section::make('Brand Assets')
                ->columnSpanFull()
                ->schema([

                    FileUpload::make('additional_info.logo')
                        ->label('Logo')
                        ->image()
                        ->disk('public_root')
                        ->directory('branding')
                        ->saveUploadedFileUsing(function ($file) {

                            $image = Image::decode($file)
                                ->encodeUsingFormat(
                                    Format::WEBP
                                );

                            $path = 'branding/' . Str::uuid() . '.webp';

                            Storage::disk('public_root')->put(
                                $path,
                                (string) $image
                            );

                            return $path;
                        }),

                    FileUpload::make('additional_info.favicon')
                        ->label('Favicon')
                        ->image()
                        ->disk('public_root')
                        ->directory('branding')
                        ->saveUploadedFileUsing(function ($file) {

                            $image = Image::decode($file)
                                ->encodeUsingFormat(
                                    Format::WEBP
                                );

                            $path = 'branding/' . Str::uuid() . '.webp';

                            Storage::disk('public_root')->put(
                                $path,
                                (string) $image
                            );

                            return $path;
                        }),
                ]),

            /*
            |--------------------------------------------------------------------------
            | SEO / Custom Code
            |--------------------------------------------------------------------------
            */
            Section::make('SEO & Custom Code')
                ->columnSpanFull()
                ->schema([

                    FileUpload::make('additional_info.llms_txt')
                        ->label('llms.txt')
                        ->disk('public_root_simple')
                        ->acceptedFileTypes([
                            'text/plain',
                        ])
                        ->maxSize(1024)
                        ->downloadable()
                        ->openable()
                        ->preserveFilenames()
                        ->getUploadedFileNameForStorageUsing(
                            fn() => 'llms.txt'
                        )
                        ->saveUploadedFileUsing(function ($file) {

                            $disk = Storage::disk('public_root_simple');

                            // Delete existing llms.txt
                            if ($disk->exists('llms.txt')) {
                                $disk->delete('llms.txt');
                            }

                            // Save new llms.txt directly in public root
                            $disk->put(
                                'llms.txt',
                                file_get_contents($file->getRealPath())
                            );

                            return 'llms.txt';
                        })
                        ->helperText('Upload the website llms.txt file.'),

                    Textarea::make('additional_info.header_scripts')
                        ->label('Header Scripts / Links')
                        ->rows(8)
                        ->columnSpanFull()
                        ->extraInputAttributes([
                            'style' => 'font-family: monospace;',
                        ])
                        ->helperText('Add scripts or links that should be placed inside the <head> section.'),

                    Textarea::make('additional_info.between_header_body_scripts')
                        ->label('Between Header & Body Scripts / Links')
                        ->rows(8)
                        ->columnSpanFull()
                        ->extraInputAttributes([
                            'style' => 'font-family: monospace;',
                        ])
                        ->helperText('Add code that should be placed between </head> and <body>.'),

                    Textarea::make('additional_info.body_scripts')
                        ->label('Body Scripts / Links')
                        ->rows(8)
                        ->columnSpanFull()
                        ->extraInputAttributes([
                            'style' => 'font-family: monospace;',
                        ])
                        ->helperText('Add scripts or links that should be placed inside the <body> section.'),

                ])
        ]);
    }
}
