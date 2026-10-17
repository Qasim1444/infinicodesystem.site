<?php

namespace App\Filament\Resources\BlogPosts\Schemas;

use App\Models\BlogPost;
use App\Support\SiteData;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
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
                        Select::make('category')
                            ->options(fn (): array => collect(self::categories())
                                ->mapWithKeys(static fn (string $category): array => [$category => $category])
                                ->all())
                            ->searchable()
                            ->native(false)
                            ->required()
                            ->createOptionForm([
                                TextInput::make('category')
                                    ->label('Category name')
                                    ->required()
                                    ->maxLength(100),
                            ])
                            ->createOptionUsing(static fn (array $data): string => trim($data['category'])),
                        TagsInput::make('tags')
                            ->suggestions(fn (): array => self::tags())
                            ->placeholder('Add tags'),
                        TextInput::make('cover_image')
                            ->maxLength(2048)
                            ->columnSpanFull()
                            ->helperText('Use a WebP image path from public storage, for example /storage/images/article.webp.'),
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

    /** @return array<int, string> */
    private static function categories(): array
    {
        return collect(SiteData::blogCategories())
            ->merge(BlogPost::query()->distinct()->pluck('category'))
            ->reject(static fn (string $category): bool => $category === 'All')
            ->filter()
            ->unique()
            ->sort()
            ->values()
            ->all();
    }

    /** @return array<int, string> */
    private static function tags(): array
    {
        return collect(SiteData::posts())
            ->pluck('tags')
            ->flatten()
            ->merge(BlogPost::query()->get(['tags'])->flatMap(static fn (BlogPost $post): array => $post->tags ?? []))
            ->filter()
            ->unique()
            ->sort()
            ->values()
            ->all();
    }
}
