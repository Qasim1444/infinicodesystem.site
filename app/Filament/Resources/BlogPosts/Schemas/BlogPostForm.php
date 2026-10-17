<?php

namespace App\Filament\Resources\BlogPosts\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class BlogPostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Article content')
                    ->columns(2)
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (?string $state, Get $get, Set $set): void {
                                if (blank($get('slug'))) {
                                    $set('slug', Str::slug($state ?? ''));
                                }
                            }),
                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        Textarea::make('excerpt')
                            ->required()
                            ->maxLength(2000)
                            ->rows(3)
                            ->columnSpanFull(),
                        Textarea::make('body')
                            ->required()
                            ->rows(18)
                            ->columnSpanFull()
                            ->helperText('Supports paragraphs, ## headings, - bullet lists, and > quotations.'),
                        Select::make('blogCategories')
                            ->label('Categories')
                            ->multiple()
                            ->relationship(name: 'blogCategories', titleAttribute: 'name')
                            ->searchable()
                            ->preload()
                            ->native(false)
                            ->required(),
                        Select::make('blogTags')
                            ->label('Tags')
                            ->multiple()
                            ->relationship(name: 'blogTags', titleAttribute: 'name')
                            ->searchable()
                            ->preload()
                            ->native(false)
                            ->placeholder('Select tags'),
                        FileUpload::make('cover_image')
                            ->image()
                            ->acceptedFileTypes(['image/webp'])
                            ->disk('public')
                            ->directory('images/blog')
                            ->visibility('public')
                            ->maxSize(5120)
                            ->formatStateUsing(static fn (?string $state): ?string => filled($state) && str_starts_with($state, '/storage/')
                                ? substr($state, strlen('/storage/'))
                                : $state)
                            ->columnSpanFull()
                            ->helperText('Browse to upload a WebP cover image. Images are stored in public storage.'),
                    ]),
                Section::make('Publishing')
                    ->columns(2)
                    ->schema([
                        TextInput::make('author_name')
                            ->required()
                            ->maxLength(120),
                        TextInput::make('author_role')
                            ->maxLength(160),
                        Select::make('status')
                            ->options([
                                'draft' => 'Draft',
                                'published' => 'Published',
                            ])
                            ->required()
                            ->native(false)
                            ->default('draft'),
                        DateTimePicker::make('published_at'),
                        Toggle::make('is_featured')
                            ->label('Feature this article on the blog')
                            ->default(false),
                    ]),
                Section::make('Search engine settings')
                    ->columns(2)
                    ->collapsed()
                    ->schema([
                        TextInput::make('meta_title')
                            ->maxLength(255),
                        Textarea::make('meta_description')
                            ->maxLength(500)
                            ->rows(3),
                    ]),
            ]);
    }
}
