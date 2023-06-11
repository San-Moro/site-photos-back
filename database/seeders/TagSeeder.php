<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = ['landscape', 'portrait', 'holiday', 'work', 'freetime', 'family', 'friends', 'black and white', 'flowers', 'nature', 'city', 'freedom', 'color', 'love', 'pets', 'animals', 'social'];
        foreach ($tags as $tag) {
            $new_tag = new Tag();
            $new_tag->name = $tag;
            $new_tag->save();
        }
    }
}
