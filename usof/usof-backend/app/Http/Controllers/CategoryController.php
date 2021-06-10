<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Post;



class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Category::all();
    }


    public function show_posts($id) {
        
        if (!Category::find($id)) {
            return response([
                'message' => 'Category isn`t exist'
            ]);
        }
        $posts = Post::all();     
        $result = [];
        foreach ($posts as $post) {

            $categories = json_decode($post->categories);
            foreach ($categories as $value) {
                if ($value == $id) 
                    $result[] = $post;            
            }
        }
        return $result;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($this->isAdmin() != true) { 
            return response([
                'message' => 'You are not admin'
            ], 400);
        }

        $fields = $request->validate([
            'title' => 'required|string|unique:categories,title',
            'description' => 'string|nullable'                  
        ]);
        $category = Category::create([
            'title' => $fields['title'],
            'description' => $fields['description']
        ]);

        return response([
            'message' => 'Category successfully created',
            'category' => $category
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
        return Category::where(['id' => $id])->first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($this->isAdmin() != true) { 
            return response([
                'message' => 'You are not admin'
            ], 400);
        }
        $fields = $request->validate([
            'title' => 'string|nullable',
            'description' => 'string|nullable'                  
        ]);
        if (!Category::find($id)) {
            return response([
                'message' => 'Category isn`t exists'
            ], 400);
        }    
        // 
        $category = Category::find($id);
        foreach ($fields as $key => $value) 
            $category->update([$key => $value]);
        
        return $category;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->isAdmin() != true) {
                     
            return response([
                'message' => 'You are not admin'
            ], 400);        
        } 
        

        if (!Category::find($id)) {
            return response([
                'message' => 'Category isn`t exists'
            ], 400);
        }
        Category::destroy($id);
    }
}
