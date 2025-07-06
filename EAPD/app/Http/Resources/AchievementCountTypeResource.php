<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AchievementCountTypeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $lang = $request->header('Accept-Language') ?? 'en';
        $lang = in_array($lang, ['ar', 'en', 'fr']) ? $lang : 'en';
        return [
            'name'=>$this['name_'.$lang],
            'count'=>$this->achievements_count ?? 0
        ];
    }
}
