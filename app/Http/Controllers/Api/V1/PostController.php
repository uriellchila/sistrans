<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

use App\Http\Requests\PostRequest;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        //
        $post=Post::create($request->all());
        return response()->json(['data'=>$post],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
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
    public function update(Request $request, Post $post)
    {
        //
        $post=Post::update($request->all());
        return response()->json(['data'=>$post],200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
        $post->delete();
        return response(null,204);

    }
}
