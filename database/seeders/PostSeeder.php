<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::factory()->count(12)->make()->each(function (Post $post) {
            User::inRandomOrder()->first()->posts()->save($post);
            Comment::factory()->count(random_int(0, 3))->make()
                ->each(function (Comment $comment) use ($post) {
                    $comment->commenter()->associate(User::inRandomOrder()->first());
                    $comment->post()->associate($post);
                    $comment->save();
                });
        });
    }
}
