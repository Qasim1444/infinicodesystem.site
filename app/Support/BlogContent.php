<?php

namespace App\Support;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Database\Eloquent\Builder;

class BlogContent
{
    /** @return array<int, array<string, mixed>> */
    public static function posts(): array
    {
        return BlogPost::published()
            ->with(['blogCategories:id,name', 'blogTags:id,name'])
            ->orderByDesc('published_at')
            ->get()
            ->map(static fn (BlogPost $post): array => $post->toPublicArray())
            ->all();
    }

    /** @return array<int, string> */
    public static function categories(): array
    {
        $categories = BlogCategory::query()
            ->whereHas('blogPosts', static function (Builder $query): void {
                $query->published();
            })
            ->orderBy('name')
            ->pluck('name')
            ->all();

        return ['All', ...$categories];
    }

    /** @return array<string, mixed>|null */
    public static function featuredPost(): ?array
    {
        $featured = BlogPost::published()
            ->with(['blogCategories:id,name', 'blogTags:id,name'])
            ->where('is_featured', true)
            ->latest('published_at')
            ->first();

        return $featured?->toPublicArray();
    }

    /** @return array<string, mixed>|null */
    public static function find(string $slug): ?array
    {
        $post = BlogPost::published()
            ->with(['blogCategories:id,name', 'blogTags:id,name'])
            ->where('slug', $slug)
            ->first();

        return $post?->toPublicArray();
    }

    /** @return array<int, array<string, mixed>> */
    public static function relatedPosts(string $slug, int $limit = 3): array
    {
        $post = self::find($slug);
        $tags = $post['tags'] ?? [];
        $others = array_values(array_filter(self::posts(), static fn (array $item): bool => $item['slug'] !== $slug));

        usort($others, static function (array $left, array $right) use ($tags): int {
            return count(array_intersect($right['tags'] ?? [], $tags)) <=> count(array_intersect($left['tags'] ?? [], $tags));
        });

        return array_slice($others, 0, $limit);
    }
}
