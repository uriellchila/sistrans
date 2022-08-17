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
    /**
     * A basic feature test example.
     * @test
     * @return void
     */
    public function stores_post()
    {
        //$user = create('App\User');
        $data=[
            'title'=>$this->faker->sentence($nbWords=6,$variableNbWords=true),
            'content'=>$this->faker->text($maxNbChars=40),
            //'author_id'=>$user->id
            
        ];
        $response=$this->json('POST',$this->baseUrl."post",$data);
        $response->assertStatus(201);
        $this->assertDatabaseHas('post',$data);
        $post=Post::all()->fisrt();
        $response->assertJson([
          'data'=>[
            'id'=>$post->id,
            'title'=>$post->title,
          ]
        ]);
    }
}
