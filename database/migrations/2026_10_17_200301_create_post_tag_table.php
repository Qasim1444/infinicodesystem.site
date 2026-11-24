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
        if (Schema::hasTable('blog_post_tag') && ! Schema::hasTable('post_tag')) {
            Schema::rename('blog_post_tag', 'post_tag');
        }

        if (! Schema::hasTable('post_tag')) {
            Schema::create('post_tag', function (Blueprint $table) {
                $table->foreignId('post_id')->constrained()->cascadeOnDelete();
                $table->foreignId('tag_id')->constrained()->cascadeOnDelete();
                $table->primary(['post_id', 'tag_id']);
            });
        }

        if (Schema::hasColumn('post_tag', 'blog_post_id')) {
            Schema::table('post_tag', fn (Blueprint $table) => $table->renameColumn('blog_post_id', 'post_id'));
        }

        if (Schema::hasColumn('post_tag', 'blog_tag_id')) {
            Schema::table('post_tag', fn (Blueprint $table) => $table->renameColumn('blog_tag_id', 'tag_id'));
        }

        Schema::dropIfExists('blog_post_category');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_tag');
    }
};
