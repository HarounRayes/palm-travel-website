<?php

namespace App\Http\Controllers\Frontend;

use App\Blog;
use App\Comment;
use App\GeneralInformation;
use App\GlobalModel;
use App\Http\Controllers\Controller;
use App\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use App\Page;
use Illuminate\Support\Facades\View;

class CommentController extends Controller
{

    public function add(Request $request, $blog)
    {
        $thisBlog = Blog::findOrFail($blog);
        $dataIn = $request->validate([
            'commenter_name' => 'required',
            'comment_text' => 'required'
        ]);
        $dataIn['blog_id'] = $blog;
        if (Auth::check())
            $dataIn['member_id'] = Auth::id();
        else
            $dataIn['member_id'] = 0;
        $Comment = Comment::create($dataIn);
        return redirect()->route('blog', ['symbol' => $thisBlog->symbol]);
    }
}
