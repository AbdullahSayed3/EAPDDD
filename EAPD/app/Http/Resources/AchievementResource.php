<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AchievementResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this['name_' . $lang],
            'description' => $this['description_' . $lang],
            'achievement_type_id' => $this->achievement_type_id,
            'achievement_type' => new AchievementTypeResource($this->achievementType),
            'image' => $this->image ? asset('uploads/achievements_file/' . $this->image) : null,
        ];
    }
}
