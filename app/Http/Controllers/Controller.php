<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Like;
use App\Models\Post;
use App\Models\Comment;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function isAdmin() {

        $user = $this->user();
        if (!$user) 
            return false;
        return ($user->role == 'admin') ?  true : false;
    }

    public function user() {
        $token = explode(' ', request()->header('Authorization'))[1];
        return User::where(['remember_token' => $token])->first();
    }


    public function count_rate($id, $type)
    {
        $like = Like::where($type.'-id', $id)->get();
        $point = 0;
        foreach($like as $i){
            if($i->type == "like")
                $point ++;
            else if ($i->type == "dislike")
                $point --;
                
        }
        if ($type == 'post') 
            Post::find($id)->update(['rating' => $point]); 
        else if ($type == 'comment') 
            Comment::find($id)->update(['rating' => $point]); 
        
        
        return $point;
    }


    public function count_rate_user($id)
    {   
        $point = 0;
        $posts = Post::where('author', $id)->get();
        foreach($posts as $post) 
            $point += $post->rating;
        
        $comments = Comment::where('author', $id)->get();
        foreach($comments as $comment)
            $point += $comment->rating;
        

        User::find($id)->update(['rating' => $point]); 
        return $point;
    }
}
