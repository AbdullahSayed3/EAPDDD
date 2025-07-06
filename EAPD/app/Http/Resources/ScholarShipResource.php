<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ScholarShipResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $lang = $request->header('Accept-Language') ?? 'en';
        $lang = in_array($lang, ['ar','en', 'fr']) ? $lang : 'en';
        
        return [
            'id'=>$this->id,
            'program'=>$lang == 'ar' ? $this->program : $this['program_'.$lang],
            'content'=>$this['content_'.$lang] ?? null,
            'image'=> $this->image ? asset('uploads/scholarships/' . $this->image) : null,
        ];
    }
}
