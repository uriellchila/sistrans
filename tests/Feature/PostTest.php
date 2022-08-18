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
    
    public function update_post(){
      
      $data=[
        'title'=>$this->faker->sentence($nbWords=6,$variableNbWords=true),
        'content'=>$this->faker->text($maxNbChars=40)
        
    ];
      User::factory()->create();
      $this->withoutExceptionHandling();
      $post= Post::factory()->create();
      $response=$this->json('PUT',$this->baseUrl."posts/{$post->id}");
      $response->assertStatus(200);
      $post=$post->fresh();
      $this->assertEquals($post->title,$data['title']);
      $this->assertEquals($post->content,$data['content']);

    }
   
}
