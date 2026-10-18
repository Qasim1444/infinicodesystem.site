<?php

namespace App\Models;

use Filament\Forms\Components\RichEditor\RichContentRenderer;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

#[Fillable([
    'user_id', 'title', 'slug', 'excerpt', 'body', 'cover_image',
    'author_name', 'author_role', 'meta_title', 'meta_description', 'status',
    'is_featured', 'published_at',
])]
class BlogPost extends Model
{
    /** @return array<string, string> */
    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    /** @param Builder<BlogPost> $query */
    public function scopePublished(Builder $query): void
    {
        $query->where('status', 'published')->whereNotNull('published_at')->where('published_at', '<=', now());
    }

    /** @return BelongsTo<User, BlogPost> */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /** @return BelongsToMany<BlogCategory, $this> */
    public function blogCategories(): BelongsToMany
    {
        return $this->belongsToMany(BlogCategory::class, 'blog_post_category');
    }

    /** @return BelongsToMany<BlogTag, $this> */
    public function blogTags(): BelongsToMany
    {
        return $this->belongsToMany(BlogTag::class, 'blog_post_tag');
    }

    /** @return array<string, mixed> */
    public function toPublicArray(): array
    {
        $date = $this->published_at ?? $this->created_at;
        $bodyBlocks = $this->bodyBlocks();
        $this->loadMissing(['blogCategories:id,name', 'blogTags:id,name']);
        $categories = $this->blogCategories->pluck('name')->all();
        $tags = $this->blogTags->pluck('name')->all();
        $image = $this->cover_image;

        if (filled($image) && ! Str::startsWith($image, ['/storage/', 'http://', 'https://'])) {
            $image = Storage::disk('public')->url($image);
        }

        return [
            'slug' => $this->slug,
            'title' => $this->title,
            'category' => $categories[0] ?? '',
            'categories' => $categories,
            'excerpt' => $this->excerpt,
            'image' => $image ?: '/storage/images/blog-featured-1-1.webp',
            'author' => $this->author_name,
            'authorRole' => $this->author_role ?: 'Contributor',
            'date' => $date?->toDateString(),
            'readTime' => max(1, (int) ceil(str_word_count($this->body) / 200)),
            'featured' => $this->is_featured,
            'tags' => $tags,
            'metaTitle' => $this->meta_title ?: $this->title,
            'metaDescription' => $this->meta_description ?: $this->excerpt,
            'body' => $bodyBlocks,
            'bodyHtml' => $this->bodyHtml(),
        ];
    }

    private function bodyHtml(): ?string
    {
        if (preg_match('/<\s*(?:p|h[1-6]|ul|ol|li|blockquote|strong|em|a|br|hr)\b/i', $this->body) !== 1) {
            return null;
        }

        return RichContentRenderer::make($this->body)->toHtml();
    }

    /** @return array<int, array<string, mixed>> */
    private function bodyBlocks(): array
    {
        $blocks = [];
        $paragraph = [];
        $list = [];

        $flushParagraph = static function () use (&$paragraph, &$blocks): void {
            if ($paragraph !== []) {
                $blocks[] = ['type' => 'p', 'text' => implode(' ', $paragraph)];
                $paragraph = [];
            }
        };
        $flushList = static function () use (&$list, &$blocks): void {
            if ($list !== []) {
                $blocks[] = ['type' => 'ul', 'items' => $list];
                $list = [];
            }
        };

        foreach (preg_split('/\R/u', $this->body) ?: [] as $line) {
            $line = trim($line);
            if ($line === '') {
                $flushParagraph();
                $flushList();
            } elseif (preg_match('/^##\s+(.+)$/u', $line, $matches) === 1) {
                $flushParagraph();
                $flushList();
                $blocks[] = ['type' => 'h2', 'text' => trim($matches[1])];
            } elseif (preg_match('/^(?:[-*])\s+(.+)$/u', $line, $matches) === 1) {
                $flushParagraph();
                $list[] = trim($matches[1]);
            } elseif (preg_match('/^>\s?(.+)$/u', $line, $matches) === 1) {
                $flushParagraph();
                $flushList();
                $blocks[] = ['type' => 'quote', 'text' => trim($matches[1])];
            } else {
                $flushList();
                $paragraph[] = $line;
            }
        }

        $flushParagraph();
        $flushList();

        return $blocks;
    }
}
