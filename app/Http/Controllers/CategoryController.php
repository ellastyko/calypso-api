<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        return response([
            'categories' => Category::paginate(12)
        ]);
    }


    public function showPostsByCategory($id) {

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
    public function store(CategoryStoreRequest $request)
    {

        $category = Category::create([
            'title' => $request['title'],
            'description' => $request['description']
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
        return response([
            'category' => Category::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryUpdateRequest $request, $id)
    {

        $category = Category::find($id);
        foreach ($request->all() as $key => $value)
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

        if (!Category::find($id)) {
            return response([
                'message' => "Category doesn't exist"
            ], 404);
        }
        Category::destroy($id);
    }
}
