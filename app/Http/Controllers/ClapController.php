<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class ClapController extends Controller
{
    public function clap(Post $post)
    {

        $hasClapped = auth()->user()->hasClapped($post);
        if($hasClapped) {
            $post->claps()->where('user_id', auth()->user()->id)->delete();
        }else{
            $post->claps()->create([
                'user_id' => auth()->user()->id,
            ]);
        }
        return response()->json([
            'clapsCount' => $post->claps()->count()
        ]);
    }
}
