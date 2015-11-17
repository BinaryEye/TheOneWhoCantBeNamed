<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\User;
use App\Post;
use App\Post_Vote;
use App\Comment;
use App\Comment_Vote;
use App\Tag;
use App\Tag_User;
use App\Post_Tag;


class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::Create();
        foreach (range(1, 10) as $seededItem) {
            User::create([
                'first_name' => $faker->name,
                'last_name' => $faker->name,
                'password' => Hash::make('123456'),
                'type' => false,
                'sex' => $faker->boolean(),
                'email' => $faker->email,
                'date_of_birth' => $faker->date('Y-m-d')
            ]);
        }
        $users = User::all()->lists('id')->toArray();
        foreach (range(1, 100) as $seededItem) {
            Post::create([
                'user_id' => $faker->randomElement($users),
                'body' => $faker->text,
                'vote_count' => 0,
            ]);
        }
        $posts = Post::all()->lists('id')->toArray();
        Comment::create([
            'user_id' => $faker->randomElement($users),
            'body' => $faker->text,
            'vote_count' => 0,
            'parent_id' => null
        ]);
        foreach (range(1, 100) as $seededItem) {
            Post_Vote::create([
                'user_id' => $faker->randomElement($users),
                'post_id' => $faker->randomElement($posts),
                'up' => $faker->boolean(),
            ]);
            Comment::create([
                'user_id' => $faker->randomElement($users),
                'parent_id' => $faker->randomElement(Comment::all()->lists('id')->toArray()),
                'post_id' => $faker->randomElement($posts),
                'body' => $faker->text,
                'vote_count' => 0
            ]);
            Tag::create([
                'name' => $faker->text,
                'private' => $faker->boolean()
            ]);
        }
        $comments = Comment::all()->lists('id')->toArray();
        $tags = Tag::all()->lists('id')->toArray();
        foreach (range(1, 100) as $seededItem) {
            Comment_Vote::create([
                'user_id' => $faker->randomElement($users),
                'comment_id' => $faker->randomElement($comments),
                'up' => $faker->boolean(),
            ]);
            Tag_User::create([
                'user_id' => $faker->randomElement($users),
                'tag_id' => $faker->randomElement($tags)
            ]);
            Post_Tag::create([
                'tag_id' => $faker->randomElement($tags),
                'post_id' => $faker->randomElement($posts),
            ]);
        }
    }
}
