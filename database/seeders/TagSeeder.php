<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = collect([
            "Javascript", "PHP", "Laravel", "Tailwind CSS", "React", "Vue", "Next JS", "Nuxt JS", "Node JS"
        ]);
        $tags->each(function ($item) {
            Tag::create([
                "name" => $item,
                "slug" => Str::slug($item)
            ]);
        });
    }
}
