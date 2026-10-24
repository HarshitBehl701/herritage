<?php

namespace App\Filament\Resources\SubCategories\Schemas;

use App\Models\Category;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Intervention\Image\Format;
use Intervention\Image\Laravel\Facades\Image;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Illuminate\Support\Facades\Storage;

class SubCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Title')
                    ->required()->placeholder('title')
                    ->maxLength(255)
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

                TextInput::make('slug')
                    ->label('Slug URL')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->regex('/^[a-z0-9-]+$/')
                    ->helperText('Auto-generated from title')
                    ->placeholder('Slug_url')
                    ->disabled()
                    ->dehydrated(),

                Select::make('cat_id')
                    ->label('Category')
                    ->options(Category::all()->pluck('title', 'id')->toArray())
                    ->searchable()
                    ->required(),

                FileUpload::make('image')
                    ->disk('public_root')
                    ->directory('sub_category')
                    ->image()
                    ->maxSize(1024)
                    ->columnSpanFull()
                   ->saveUploadedFileUsing(function (TemporaryUploadedFile $file) {
                        $path = 'subcategories/' . Str::uuid() . '.webp';

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
                            ->minWidth(1080)
                            ->maxWidth(1080)
                            ->minHeight(1080)
                            ->maxHeight(1080),
                    ])->validationMessages([
                            'dimensions' => 'Image dimensions must be exactly 1080 × 1080 pixels.',
                        ]),

                FileUpload::make('content.images')
                    ->disk('public_root')
                    ->directory('sub_categories')
                    ->image()->multiple()
                    ->maxSize(2 * 1024)
                    ->columnSpanFull()
                   ->saveUploadedFileUsing(function (TemporaryUploadedFile $file) {
                        $path = 'subcategories/' . Str::uuid() . '.webp';

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
                            ->minWidth(1080)
                            ->maxWidth(1080)
                            ->minHeight(1080)
                            ->maxHeight(1080),
                    ])->validationMessages([
                            'dimensions' => 'Image dimensions must be exactly 1080 × 1080 pixels.',
                        ]),


                RichEditor::make('description')
                    ->label('Description')->columnSpanFull()->required(),


                RichEditor::make('content.features')
                    ->label('Features')->columnSpanFull()
                    ->nullable(),

                RichEditor::make('content.why_choose_us')
                    ->label('Why Choose Us')->columnSpanFull()
                    ->nullable(),

                RichEditor::make('content.contact_us')
                    ->label('Contact Us')->columnSpanFull()
                    ->nullable(),


                Toggle::make('status')
                    ->label('Active')
                    ->onColor('success')
                    ->offColor('danger')
                    ->default(true),
                Toggle::make('featured')
                    ->label('Featured?')
                    ->default(false),
                Toggle::make('seo')
                    ->label('Required SEO?')
                    ->default(false),
                // Toggle::make('explore')
                //     ->label('Hide From Navigation?')
                //     ->default(false)
            ]);
    }
}
