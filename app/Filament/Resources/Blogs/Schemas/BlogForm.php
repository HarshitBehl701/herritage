<?php

namespace App\Filament\Resources\Blogs\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Format;
use Intervention\Image\Laravel\Facades\Image;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Illuminate\Validation\Rule;

class BlogForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Title
                TextInput::make('title')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function ($state, callable $set) {
                        $set('slug', Str::slug($state));
                    }),

                TextInput::make('order')
                    ->label('Order')
                    ->numeric()
                    ->integer()
                    ->required()
                    ->minValue(1)
                    ->visibleOn('edit')
                    ->helperText('If this order is already in use, the two records will swap orders when you save.'),

                // Slug
                TextInput::make('slug')
                    ->required()
                    ->disabled()
                    ->dehydrated()
                    ->unique(ignoreRecord: true),

                // Featured Image
                FileUpload::make('image')
                    ->image()
                    ->columnSpanFull()
                    ->maxSize(3 * 1024)
                    ->disk('public_root')
                    ->directory('blogs')
                    ->saveUploadedFileUsing(function (TemporaryUploadedFile $file) {
                        $path = 'blogs/' . Str::uuid() . '.webp';

                        $encoded = Image::decode($file)
                            ->encodeUsingFormat(
                                Format::WEBP
                            );

                        Storage::disk('public_root')->put(
                            $path,
                            (string) $encoded
                        );

                        return $path;
                    })
                    ->rules([
                        Rule::dimensions()
                            ->minWidth(1600)
                            ->maxWidth(1600)
                            ->minHeight(800)
                            ->maxHeight(800),
                    ])->validationMessages([
                            'dimensions' => 'Image dimensions must be exactly 1600 × 800 pixels.',
                    ]),

                // Content Images
                FileUpload::make('content.images')
                    ->image()
                    ->multiple()
                    ->columnSpanFull()
                    ->maxSize(3 * 1024)
                    ->disk('public_root')
                    ->directory('blogs')
                    ->saveUploadedFileUsing(function (TemporaryUploadedFile $file) {
                        $path = 'blogs/' . Str::uuid() . '.webp';

                        $encoded = Image::decode($file)
                            ->encodeUsingFormat(
                                Format::WEBP
                            );

                        Storage::disk('public_root')->put(
                            $path,
                            (string) $encoded
                        );

                        return $path;
                    }),

                RichEditor::make('description')
                    ->columnSpanFull()
                    ->required(),

                Toggle::make('status')
                    ->label('Active')
                    ->default(true),
            ]);
    }
}