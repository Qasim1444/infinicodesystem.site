<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use Illuminate\Database\Seeder;

class BlogCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (['Web Development', 'AI & Automation', 'Technology'] as $name) {
            BlogCategory::query()->firstOrCreate(['name' => $name]);
        }
    }
}
