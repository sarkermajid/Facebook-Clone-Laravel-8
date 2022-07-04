<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){

        $allPosts = Post::query()->get();

        $posts = array();
        foreach($allPosts as $post){
            $posts [] = array(
                'status' => $post->status ?? '',
                'photo' => $post->photo?? '',
                'likes' => count(json_decode($post->likes)) ?? '',
                'shares' => count(json_decode($post->shares)) ?? '',
                'comments' => $post->comments ?? '',
                'user' => User::find($post->user_id),
                'created_at'=> date("F j, Y, g:i a", strtotime($post->created_at)),
            );
        }


        return view('dashboard',compact('posts'));
    }
}
