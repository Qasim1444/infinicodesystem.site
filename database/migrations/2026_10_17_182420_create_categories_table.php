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
        if (Schema::hasTable('blog_categories') && ! Schema::hasTable('categories')) {
            Schema::rename('blog_categories', 'categories');
        }

        if (! Schema::hasTable('categories')) {
            Schema::create('categories', function (Blueprint $table) {
                $table->id();
                $table->string('name', 100)->unique();
                $table->string('slug', 100)->unique();
                $table->text('description')->nullable();
                $table->timestamps();
            });

            return;
        }

        if (! Schema::hasColumn('categories', 'slug')) {
            Schema::table('categories', function (Blueprint $table) {
                $table->string('slug', 100)->nullable()->unique()->after('name');
            });
        }

        foreach (DB::table('categories')->whereNull('slug')->orderBy('id')->get(['id', 'name']) as $category) {
            $baseSlug = Str::slug($category->name) ?: "category-{$category->id}";
            $slug = $baseSlug;
            $suffix = 2;

            while (DB::table('categories')->where('slug', $slug)->exists()) {
                $slug = "{$baseSlug}-{$suffix}";
                $suffix++;
            }

            DB::table('categories')->where('id', $category->id)->update(['slug' => $slug]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
