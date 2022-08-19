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
    
    public function deletes_post(){
      
      User::factory()->create();
      //$post = create('App\Models\Post');
      $post= Post::factory()->create();
      $this->json('DELETE',$this->baseUrl."posts/{$post->id}")
          ->assertStatus(204);
      $this->assertNull(Post::find($post->id));
    } 
    public function update_post(){
      
      $data=[
        'title'=>$this->faker->sentence($nbWords=6,$variableNbWords=true),
        'content'=>$this->faker->text($maxNbChars=40)
        
    ];
      User::factory()->create();
      $this->withoutExceptionHandling();
      $post= Post::factory()->create();
      $response=$this->json('PUT',$this->baseUrl."posts/{$post->id}", $data);
      $response->assertStatus(200);
      $post=$post->fresh();
      $this->assertEquals($post->title,$data['title']);
      $this->assertEquals($post->content,$data['content']);

    }
    public function shows_post(){
    
      User::factory()->create();
      $this->withoutExceptionHandling();
      $post= Post::factory()->create();
      $response=$this->json('GET',$this->baseUrl."posts/{$post->id}");
      $response->assertStatus(200);
      $response->assertJson([
        'data'=>[
          'id'=>$post->id,
          'title'=>$post->title
        ]
      ]);

    }
   
}
