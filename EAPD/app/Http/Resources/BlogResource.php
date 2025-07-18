<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'title'=>$this->title,
            'content'=>$this->content,
            'cover'=>$this->cover != null ? asset('uploads/blogs_file/' . $this->cover) : null,
            'created_at'=>$this->updated_at->format('Y-m-d H:i:s'),
            'images'=> $this->images->map(function ($image) {
                return asset('uploads/blogs_file/' . $image->image);
            })->toArray(),
        ];
    }
}
