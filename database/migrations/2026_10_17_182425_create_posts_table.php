<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('blog_posts') && ! Schema::hasTable('posts')) {
            Schema::rename('blog_posts', 'posts');
        }

        if (! Schema::hasTable('posts')) {
            Schema::create('posts', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
                $table->string('title');
                $table->string('meta_title')->nullable();
                $table->text('meta_description')->nullable();
                $table->string('slug')->unique();
                $table->text('excerpt');
                $table->longText('content');
                $table->string('image')->nullable();
                $table->boolean('is_published')->default(false);
                $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
                $table->string('author_name')->nullable();
                $table->string('author_role')->nullable();
                $table->string('status')->default('draft')->index();
                $table->boolean('is_featured')->default(false);
                $table->timestamp('published_at')->nullable()->index();
                $table->timestamps();
            });

            return;
        }

        if (! Schema::hasColumn('posts', 'content') && Schema::hasColumn('posts', 'body')) {
            Schema::table('posts', fn (Blueprint $table) => $table->renameColumn('body', 'content'));
        }

        if (! Schema::hasColumn('posts', 'image') && Schema::hasColumn('posts', 'cover_image')) {
            Schema::table('posts', fn (Blueprint $table) => $table->renameColumn('cover_image', 'image'));
        }

        if (! Schema::hasColumn('posts', 'is_published')) {
            Schema::table('posts', fn (Blueprint $table) => $table->boolean('is_published')->default(false)->after('image'));
        }

        if (! Schema::hasColumn('posts', 'category_id')) {
            Schema::table('posts', function (Blueprint $table) {
                $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
            });
        }

        if (Schema::hasColumn('posts', 'author_name')) {
            Schema::table('posts', fn (Blueprint $table) => $table->string('author_name')->nullable()->change());
        }

        if (Schema::hasColumn('posts', 'category')) {
            Schema::table('posts', fn (Blueprint $table) => $table->string('category')->nullable()->change());

            foreach (DB::table('posts')->whereNull('category_id')->whereNotNull('category')->where('category', '<>', '')->get(['id', 'category']) as $post) {
                $categoryId = DB::table('categories')->where('name', $post->category)->value('id');

                if (! $categoryId) {
                    $baseSlug = Str::slug($post->category) ?: "category-{$post->id}";
                    $slug = $baseSlug;
                    $suffix = 2;

                    while (DB::table('categories')->where('slug', $slug)->exists()) {
                        $slug = "{$baseSlug}-{$suffix}";
                        $suffix++;
                    }

                    $categoryId = DB::table('categories')->insertGetId([
                        'name' => $post->category,
                        'slug' => $slug,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                DB::table('posts')->where('id', $post->id)->update(['category_id' => $categoryId]);
            }
        }

        if (Schema::hasTable('blog_post_category')) {
            foreach (DB::table('blog_post_category')->orderBy('blog_post_id')->get(['blog_post_id', 'blog_category_id']) as $pivot) {
                DB::table('posts')->where('id', $pivot->blog_post_id)->whereNull('category_id')->update([
                    'category_id' => $pivot->blog_category_id,
                ]);
            }
        }

        if (Schema::hasColumn('posts', 'status')) {
            DB::table('posts')->where('status', 'published')->update(['is_published' => true]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
