<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory(1)->create();
        $post = new Post();

        $post->title = fake()->word;
        $post->description = fake()->paragraph(3);
        $post->user_id = $user[0]->id;

        $post->save();

    }
}
