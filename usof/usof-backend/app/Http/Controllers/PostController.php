<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Like;
use App\Models\User;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // Get all posts
    public function index()
    {
        return Post::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // Create new post
    public function store(Request $request)
    {
        try {

            $fields = $request->validate([

                'title' => 'required|string',   
                'content' => 'required|string',        
                'categories' => 'required|array'
            ]);
            
            $fields['categories'] = json_encode($fields['categories']); 
    
            $user = $this->user();
            $fields['author'] = $user->id;
    
            $post = Post::create([
                'author' => $fields['author'],
                'title' => $fields['title'],   
                'content' => $fields['content'],        
                'categories' => $fields['categories']
            ]); 

        } catch (\Exception $e) {
            return response([
                'message' => $e->getMessage()
            ]);
        }
        
        
        return response([
            'message' => 'You have created post',
            'post' => $post
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Post::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // Update post
    public function update(Request $request, $id)
    {
        try {

            $fields = $request->validate([

                'title' => 'string',   
                'content' => 'string',        
                'categories' => 'array'
            ]);
            $fields['categories'] = json_encode($fields['categories']);
    
            $user = $this->user();
                  
            $post = Post::find($id);
    
            if ($user->id == $post->author || $user->role == 'admin') {
                foreach ($fields as $key => $value) 
                    $post->update([$key => $value]);
            }
            else {
                return response([
                    'message' => 'You can`t edit post'
                ], 400);
            }
            

        } catch (\Exception $e) {
            return response([
                'message' => $e->getMessage()
            ], 400);
        } 
        
        
        return response([
            'message' => 'Edited'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Post::find($id)) {
            return response([
                'message' => 'Post isn`t exist'
            ], 400);
        }

        if ($this->isAdmin() == true) {
            Post::destroy($id);         
            return response([
                'message' => 'Post deleted'
            ], 400);        
        } 
        
        $user = $this->user();
              
        $post = Post::find($id);

        if ($user->id != $post->author) {
            return response([
                'message' => 'You can`t delete this post'
            ], 400);
        }
        Post::destroy($id);  
        return response([
            'message' => 'You have deleted post'
        ]);         
    }



    public function show_categories($id) {

        $post = Post::find($id);
        if (!$post) {
            return response([
                'message' => 'Post isn`t exist'
            ], 400);
        }
        $categories = json_decode($post->categories);

        $result = [];
        foreach ($categories as $value) {
            $ctg = Category::where(['title' => $value])->first();
            if ($ctg) {
                $result[] = $ctg;
            }           
        }
        return $result;
    }


    // Comments
    public function store_comment(Request $request, $id) {

        if(!Post::find($id)) {
            return response([
                'message' => 'Post isn`t exist'
            ], 400);
        }
        try {
            $fields = $request->validate(['content' => 'required|string']);

            $user = $this->user();

            $fields['author'] = $user->id;
            
            Comment::create([
                'author' => $fields['author'],
                'post-id' => $id,
                'content' => $fields['content']   
            ]);

        } catch (\Exception $e) {
            return response([
                'message' => $e->getMessage()
            ], 400);
        }
        return response([
            'message' => 'You have created comment'
        ]);
    }


    public function show_comments($id) {

        if (!Comment::where(['post-id' => $id])) {
            return response([
                'message' => 'Post isn`t exists'
            ], 400);
        }
        return Comment::where(['post-id' => $id])->get();
    }


    // Likes
    public function show_likes($id) {
        if(!Post::find($id)) {
            return response([
                'message' => 'Post isn`t exist'
            ], 400);
        }
        return Like::where(['post-id' => $id])->get();
    }

    public function store_like(Request $request, $id) {

        try {
            if(!Post::find($id)) {
                return response([
                    'message' => 'Post isn`t exist'
                ], 400);
            }
            $fields = $request->validate([
                'type' => 'string'
            ]);
            
            $user = $this->user();
            
            $like = Like::where(['post-id' => $id, 'author' => $user->id])->first();
            if ($like) {
                $like->update(['type' => $fields['type']]);
            }
            else {
                Like::create([
                    'author' => $user->id,
                    'post-id' => $id,
                    'type' => $fields['type']
                ]);
            }    
        } catch (\Exception $e) {
            return response([
                'message' => $e->getMessage()
            ], 400);
        }
        
        return response([
            'message' => 'You have rated post'
        ]);
    }   


    public function destroy_like($id)
    {
        if(!Post::find($id)) {
            return response([
                'message' => 'Post isn`t exist'
            ], 400);
        }
        $user = $this->user();
        

        return (Like::where(['post-id' => $id, 'author' => $user->id])->delete() == true) 
            ? response(['message' => 'You have deleted your rate']) 
            : response(['message' => 'Something wrong'], 400);     
    }
}
