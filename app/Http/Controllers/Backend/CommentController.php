<?php

namespace App\Http\Controllers\Backend;

use App\Blog;
use App\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('permission:blogs.comment');
    }
    public function index()
    {
//            if admin
//            $comments = Comment::withTrashed()->get();
        if (request()->blog) {
            $blog = Blog::findOrFail(request()->blog);
            $comments = Comment::where('blog_id', \request()->blog)->orderBy('id', 'DESC')->get();
            return view('backend.comment.index')->with(['comments' => $comments, 'blog' => $blog]);
        } else {
            return redirect()->route('admin.blogs.index');
        }
    }
    public function show($blog, $comment)
    {
        $comment = Comment::findOrFail($comment);
        return view('backend.comment.show')->with(['comment' => $comment]);
    }
    public function create()
    {
        if (request()->blog) {
            $blog = Blog::findOrFail(request()->blog);
            return view('backend.comment.create')->with(['blog' => $blog]);
        } else {
            return redirect()->route('admin.blogs.index');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'image_en' => 'required',
            'image_ar' => 'required',
            'text_en' => 'nullable',
            'text_ar' => 'nullable'
        ]);

        $comment = Comment::create($request->all());
        $dataUp = [];

        $comment->update($dataUp);
        return redirect()->route('admin.blogs.comments.index', ['blog' => $comment->blog_id]);
    }

    public function edit($blog, $comment)
    {
        $comment = Comment::findOrFail($comment);
        return view('backend.comment.edit')->with(['comment' => $comment]);
    }

    public function update(Request $request, $blog, $comment)
    {
        $request->validate([
            'status' => 'required'
        ]);
        $commentModel = Comment::findOrFail($comment);
        $commentModel->update($request->all());

        return redirect()->route('admin.blogs.comments.index', ['blog' => $blog]);
    }

    public function destroy($blog, $comment)
    {
        $comment = Comment::findOrFail($comment);
        $comment->delete();
        return redirect()->route('admin.blogs.comments.index', ['blog' => $blog]);
    }

    public function restorecomment($blog, $comment)
    {
        $comment = Comment::findOrFail($comment);
        $comment->restore();
        return redirect()->route('admin.blogs.comments.index', ['blog' => $comment->blog_id]);
    }
}
