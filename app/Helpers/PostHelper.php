<?php

namespace App\Helpers;

use App\Models\Post;

class PostHelper
{
    public static function getPostByDiscipline($discipline)
    {
        // dd($discipline);
        // return Post::where('discipline', $discipline)->orderBy('created_at', 'desc');
        return Post::where('discipline', $discipline)->orderBy('created_at', 'desc')->paginate(20);
    }

    public static function getPostById($id)
    {
        return Post::find($id);
    }

    public static function getPostByYear($year)
    {
        return Post::where('year', $year)->paginate(20);
    }

    public static function getAllPosts()
    {
        return Post::all();
    }
}