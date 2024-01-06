<?php

namespace App\Http\Controllers\Api;

use App\Blog;
use App\BlogSlider;
use App\Comment;
use App\GeneralInformation;
use App\Http\Controllers\Controller;
use App\Http\Resources\Blog\BlogResource;
use App\Http\Resources\Blog\BlogSliderResource;
use App\Http\Resources\Blog\ListBlogResource;
use App\Http\Resources\GeneralInfoResource;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function index()
    {
        try {
            return new ListBlogResource(Blog::paginate(10));
        } catch (\Exception $e) {
            throw $e;
        }

    }

    public function view(Request $request, $id)
    {
        try {
            $result = Blog::findOrFail($id);
            return response()->json([
                "success" => true,
                "message" => "",
                "data" => new BlogResource($result),
                "total" => 1,
                "status" => 200
            ]);
        } catch (\Exception $e) {
            throw $e;
        }

    }

    public function info(Request $request)
    {
        try {
            $result = GeneralInformation::where('type', 'blog')->first();
            return response()->json([
                "success" => true,
                "message" => "",
                "data" => new GeneralInfoResource($result),
                "total" => 1,
                "status" => 200
            ]);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function slider(Request $request, $id)
    {
        try {
            $results = BlogSlider::where('blog_id', $id)->get();
            return response()->json([
                "success" => true,
                "message" => "",
                "data" => BlogSliderResource::collection($results),
                "total" => count($results),
                "status" => 200
            ]);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function add_comment(Request $request, $id)
    {
        $dataIn = $request->all();
        $validator = Validator::make($dataIn, [
            'commenter_name' => 'required',
            'comment_text' => 'required'
        ]);

        if ($validator->fails()) {
            $data = [
                'success' => false,
                "message" => 'Validation Error',
                'data' => $validator->errors(),
                "count" => count($validator->errors()),
                "status" => 422
            ];
            throw new HttpResponseException(response()->json(
                $data, 422));
        }

        $dataIn['blog_id'] = $id;
        if (Auth::check())
            $dataIn['member_id'] = Auth::id();
        else
            $dataIn['member_id'] = 0;
        Comment::create($dataIn);
        return response()->json([
            "success" => true,
            "message" => "Comment has added successfully",
            "data" => [],
            "total" => 0,
            "status" => 200
        ]);
    }
}
