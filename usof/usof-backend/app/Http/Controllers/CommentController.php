<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Like;

class CommentController extends Controller
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comment = Comment::find($id);
        if (!$comment) {
            return response([
                'message' => 'Comment isn`t exist'
            ], 400);
        }
        return $comment;
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
        try {

            $comment = Comment::find($id);
            if (!$comment) {
                return response([
                    'message' => 'Comment isn`t exist'
                ], 400);
            }

            $user = $this->user();
            if ($user->id != $comment->author && $user->role != 'admin') {
                return response([
                    'message' => 'You can`t edit this comment'
                ], 400);
            }
            $fields = $request->validate(['content' => 'required|string']);
            $comment->update(['content' => $fields['content']]);

        } catch (\Exception $e) {
            return response([
                'message' => $e->getMessage()
            ], 400);
        }
        
        return response([
            'message' => 'Comment updated'
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
        try {
            
            $comment = Comment::find($id);
            if (!$comment) {
                return response([
                    'message' => 'Comment isn`t exist'
                ], 400);
            }
            $comment->delete();

        } catch (\Exception $e) {
            return response([
                'message' => $e->getMessage()
            ], 400);
        }
        
        return response([
            'message' => 'Comment deleted'
        ]);
    }


    ###############  Лайки и комментарии  ##################
    
    public function show_likes($id) {

        if(!Comment::find($id)) {
            return response([
                'message' => 'Comment isn`t exist'
            ], 400);
        }
        return Like::where(['comment-id' => $id])->get();
    }   


    public function store_like(Request $request, $id) {

        try {

            if(!Comment::find($id)) {
                return response([
                    'message' => 'Comment isn`t exist'
                ], 400);
            }
            $fields = $request->validate([
                'type' => 'required|string'
            ]);

            $user = $this->user();
            
            $like = Like::where(['comment-id' => $id, 'author' => $user->id])->first();
            if ($like) {
                $like->update(['type' => $fields['type']]);
            }
            else {
                Like::create([
                    'author' => $user->id,
                    'comment-id' => $id,
                    'type' => $fields['type']
                ]);
            }    
        } catch (\Exception $e) {
            return response([
                'message' => $e->getMessage()
            ], 400);
        }
        
        return response([
            'message' => 'You have rated comment'
        ]);
    }   


    public function destroy_like($id) {

        if(!Comment::find($id)) {
            return response([
                'message' => 'Comment isn`t exist'
            ], 400);
        }
        
        $user = $this->user();

        return (Like::where(['comment-id' => $id, 'author' => $user->id])->delete() == true) 
            ? response(['message' => 'You have deleted your rate']) 
            : response(['message' => 'Something wrong'], 400);     
    }

}
