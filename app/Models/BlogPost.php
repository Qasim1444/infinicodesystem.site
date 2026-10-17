<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'user_id', 'title', 'slug', 'excerpt', 'body', 'category', 'tags', 'cover_image',
    'author_name', 'author_role', 'meta_title', 'meta_description', 'status',
    'is_featured', 'published_at',
])]
class BlogPost extends Model
{
    /** @return array<string, string> */
    protected function casts(): array
    {
        return [
            'tags' => 'array',
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

    /** @return array<string, mixed> */
    public function toPublicArray(): array
    {
        $date = $this->published_at ?? $this->created_at;
        $bodyBlocks = $this->bodyBlocks();

        return [
            'slug' => $this->slug,
            'title' => $this->title,
            'category' => $this->category,
            'excerpt' => $this->excerpt,
            'image' => $this->cover_image ?: '/storage/images/blog-featured-1-1.webp',
            'author' => $this->author_name,
            'authorRole' => $this->author_role ?: 'Contributor',
            'date' => $date?->toDateString(),
            'readTime' => max(1, (int) ceil(str_word_count($this->body) / 200)),
            'featured' => $this->is_featured,
            'tags' => $this->tags ?? [],
            'metaTitle' => $this->meta_title ?: $this->title,
            'metaDescription' => $this->meta_description ?: $this->excerpt,
            'body' => $bodyBlocks,
        ];
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
