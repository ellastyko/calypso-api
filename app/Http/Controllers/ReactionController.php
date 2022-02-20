<?php

namespace App\Http\Controllers;

use App\Models\Reaction;
use App\Models\Post;
use Illuminate\Http\Request;

class ReactionController extends Controller
{
    ###############  Post's likes ##################

    public function showPostLikes($id)
    {
        // TODO
    }

    public function storePostLike(Request $request, $id)
    {

        // TODO
    }


    public function destroyPostLike($id)
    {
        // TODO
    }



    ###############  Comment's likes ##################

    public function showCommentLikes($id)
    {

        // TODO
    }


    public function storeCommentLike(Request $request, $id)
    {

        // TODO
    }


    public function destroyCommentLike($id)
    {

        // TODO
    }
}
