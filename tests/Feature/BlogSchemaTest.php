<?php

namespace Tests\Feature;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class BlogSchemaTest extends TestCase
{
    use RefreshDatabase;

    public function test_imported_post_uses_the_new_tables_and_pivot_columns(): void
    {
        $now = now();
        $categoryId = DB::table('categories')->insertGetId([
            'name' => 'Example category',
            'slug' => 'example-category',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        $tagId = DB::table('tags')->insertGetId([
            'name' => 'Example tag',
            'slug' => 'example-tag',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        $postId = DB::table('posts')->insertGetId([
            'title' => 'Example post',
            'meta_title' => 'Example post',
            'meta_description' => 'An imported post.',
            'slug' => 'example-post',
            'excerpt' => 'An imported post.',
            'content' => 'Example content.',
            'image' => null,
            'is_published' => true,
            'category_id' => $categoryId,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('post_tag')->insert([
            'post_id' => $postId,
            'tag_id' => $tagId,
        ]);

        $post = BlogPost::query()
            ->with(['category:id,name', 'blogTags:id,name'])
            ->findOrFail($postId);

        $this->assertSame('Example category', $post->category?->name);
        $this->assertSame('Example tag', $post->blogTags->first()?->name);
        $this->assertSame([$postId], BlogCategory::query()->findOrFail($categoryId)->posts->pluck('id')->all());
        $this->assertTrue(BlogPost::published()->whereKey($postId)->exists());
        $this->assertSame('Infinicode System', $post->toPublicArray()['author']);
    }
}
