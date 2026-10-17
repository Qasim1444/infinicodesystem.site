<?php

namespace Database\Seeders;

use App\Models\BlogTag;
use Illuminate\Database\Seeder;

class BlogTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (['Laravel', 'Web Development', 'Artificial Intelligence'] as $name) {
            BlogTag::query()->firstOrCreate(['name' => $name]);
        }
    }
}
