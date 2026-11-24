<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
                $table->string('author_name');
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
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
