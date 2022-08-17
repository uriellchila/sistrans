<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use \App\Models\Post;
use \App\Models\User;

class PostTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    //use WithFaker;
    /**
     * A basic feature test example.
     * @test
     * 
     */
    public function stores_post()
    {
        $user = User::factory()->create();
        $data=[
            'title'=>$this->faker->sentence($nbWords=6,$variableNbWords=true),
            'content'=>$this->faker->text($maxNbChars=40),
            'author_id'=> $user->id
            
        ];
        $this->withoutExceptionHandling();
        $response=$this->json('POST',$this->baseUrl.'posts',$data);
        $response->assertStatus(201);
        $this->assertDatabaseHas('posts',$data);
        $post=Post::all()->first();
        $response->assertJson([
          'data'=>[
            'id'=>$post->id,
            'title'=>$post->title,
          ]
        ]);
    }
}
