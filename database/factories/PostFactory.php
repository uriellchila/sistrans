<?php

namespace Database\Factories;
use App\Models\User;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return[
            'title'=>$this->faker->sentence($nbWords=6,$variableNbWords=true),
            'author_id'=>User::all()->random(),
            'content'=>$this->faker->text($maxNbChars=200)
        ];
    }
}
