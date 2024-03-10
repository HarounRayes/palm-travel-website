<?php

namespace App\Http\Resources\Blog;


use Illuminate\Http\Resources\Json\JsonResource;

class BlogCommentResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $response = [
            'commenter_name' => $this->commenter_name,
            'comment_text' => $this->comment_text,
        ];

        return $response;
    }

}
