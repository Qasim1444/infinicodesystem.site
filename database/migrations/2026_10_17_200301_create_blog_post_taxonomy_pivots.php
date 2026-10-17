<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('blog_post_category', function (Blueprint $table) {
            $table->foreignId('blog_post_id')->constrained()->cascadeOnDelete();
            $table->foreignId('blog_category_id')->constrained()->cascadeOnDelete();
            $table->primary(['blog_post_id', 'blog_category_id']);
        });

        Schema::create('blog_post_tag', function (Blueprint $table) {
            $table->foreignId('blog_post_id')->constrained()->cascadeOnDelete();
            $table->foreignId('blog_tag_id')->constrained()->cascadeOnDelete();
            $table->primary(['blog_post_id', 'blog_tag_id']);
        });

        foreach (DB::table('blog_posts')->get(['id', 'category', 'categories', 'tags']) as $post) {
            $categories = $this->decodeArray($post->categories);
            if (filled($post->category)) {
                $categories[] = $post->category;
            }

            foreach (array_unique(array_filter($categories)) as $categoryName) {
                $categoryId = DB::table('blog_categories')->where('name', $categoryName)->value('id');
                if (! $categoryId) {
                    $categoryId = DB::table('blog_categories')->insertGetId([
                        'name' => $categoryName,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                DB::table('blog_post_category')->insertOrIgnore([
                    'blog_post_id' => $post->id,
                    'blog_category_id' => $categoryId,
                ]);
            }

            foreach (array_unique(array_filter($this->decodeArray($post->tags))) as $tagName) {
                $tagId = DB::table('blog_tags')->where('name', $tagName)->value('id');
                if (! $tagId) {
                    $tagId = DB::table('blog_tags')->insertGetId([
                        'name' => $tagName,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                DB::table('blog_post_tag')->insertOrIgnore([
                    'blog_post_id' => $post->id,
                    'blog_tag_id' => $tagId,
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_post_tag');
        Schema::dropIfExists('blog_post_category');
    }

    /**
     * @return array<int, string>
     */
    private function decodeArray(?string $value): array
    {
        $decoded = json_decode($value ?? '[]', true);

        return is_array($decoded) ? array_values(array_filter($decoded, 'is_string')) : [];
    }
};
