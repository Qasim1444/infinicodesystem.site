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
        if (Schema::hasTable('blog_tags') && ! Schema::hasTable('tags')) {
            Schema::rename('blog_tags', 'tags');
        }

        if (! Schema::hasTable('tags')) {
            Schema::create('tags', function (Blueprint $table) {
                $table->id();
                $table->string('name', 100)->unique();
                $table->string('slug', 100)->unique();
                $table->timestamps();
            });

            return;
        }

        if (! Schema::hasColumn('tags', 'slug')) {
            Schema::table('tags', function (Blueprint $table) {
                $table->string('slug', 100)->nullable()->unique()->after('name');
            });
        }

        foreach (DB::table('tags')->whereNull('slug')->orderBy('id')->get(['id', 'name']) as $tag) {
            $baseSlug = Str::slug($tag->name) ?: "tag-{$tag->id}";
            $slug = $baseSlug;
            $suffix = 2;

            while (DB::table('tags')->where('slug', $slug)->exists()) {
                $slug = "{$baseSlug}-{$suffix}";
                $suffix++;
            }

            DB::table('tags')->where('id', $tag->id)->update(['slug' => $slug]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tags');
    }
};
