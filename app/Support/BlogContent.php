<?php

namespace App\Support;

use App\Models\BlogPost;

class BlogContent
{
    /** @return array<int, array<string, mixed>> */
    public static function posts(): array
    {
        $postsBySlug = [];

        foreach (SiteData::posts() as $post) {
            $postsBySlug[$post['slug']] = $post;
        }

        foreach (BlogPost::published()->orderByDesc('published_at')->get() as $post) {
            $postsBySlug[$post->slug] = $post->toPublicArray();
        }

        $posts = array_values($postsBySlug);
        usort($posts, static fn (array $left, array $right): int => strcmp($right['date'] ?? '', $left['date'] ?? ''));

        return $posts;
    }

    /** @return array<int, string> */
    public static function categories(): array
    {
        $categories = array_values(array_unique(array_merge(
            SiteData::blogCategories(),
            BlogPost::published()->distinct()->orderBy('category')->pluck('category')->all(),
        )));

        return array_values(array_unique(array_merge(['All'], array_filter($categories, static fn (string $category): bool => $category !== 'All'))));
    }

    /** @return array<string, mixed>|null */
    public static function featuredPost(): ?array
    {
        $featured = BlogPost::published()->where('is_featured', true)->latest('published_at')->first();

        return $featured?->toPublicArray() ?? SiteData::featuredPost();
    }

    /** @return array<string, mixed>|null */
    public static function find(string $slug): ?array
    {
        $post = BlogPost::published()->where('slug', $slug)->first();

        return $post?->toPublicArray() ?? SiteData::getPost($slug);
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
