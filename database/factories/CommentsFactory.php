<?php

namespace Database\Factories;
use App\Models\User;
use App\Models\Post;
use App\Models\Comments;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CommentsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comments::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return[
            'content'=>$this->faker->text($maxNbChars = 200),
            'user_id'=>User::all()->random(),
            'post_id'=>Post::all()->random()
        ];
    }
}