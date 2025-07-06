<?php

namespace App\Http\Resources;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AidResource extends JsonResource
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
        $country = Country::where('code',$this->country_id)->first();
        return [
            'id'=> $this->id,
            'title' => $this['title_' . $lang],
            'type'=> $this->type ? $this->type['name_' . $lang] : null,
            'contry_org' => $this->country_org,
            'description' => $this['description_' . $lang],
            'image' => $this->image ? asset('uploads/aids_file/' . $this->image) : null,
            'file' => $this->file ? asset('uploads/aids_doc/' . $this->file) : null,
            'country'=>$country ? $country['name_' . $lang] : null,
            'url' => $this->url,
            'contact' => $this->contact,

        ] ;
    }
}
