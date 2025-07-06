<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AidTypeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $lang = request()->header('Accept-Language') ?? 'en';
        $lang = in_array($lang, ['ar', 'en', 'fr']) ? $lang : 'en';
        if($lang == 'fr'){
            $lang = 'en'; // Use English for French as per the original code logic
        }
        return [
            'id'=> $this->id,
            'name'=>$this['name_'.$lang],
            'image' => $this->image ? asset('uploads/aids_types/' . $this->image) : null,
        ];
    }
}
