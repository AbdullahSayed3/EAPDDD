<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
        
        $lang = $request->header('Accept-Language') ?? 'en';
        $lang = in_array($lang, ['ar','en', 'fr']) ? $lang : 'en';
        if($this->countries)
        {
            $countrieIds = unserialize($this->countries);
            $countriesName = \App\Models\Country::whereIn('code', $countrieIds)->pluck('name_'.$lang)->toArray(); 
        }
        $images = json_decode($this->images, true);
        return [
            'id' => $this->id,
            'image' => $this->image ? asset('uploads/courses_file/' . $this->image) : null,
           'images' => $images ? collect($images)->map(function ($image) {
                return asset('uploads/courses_file/' . $image);
            })->toArray() : [],
            'name'=> $this['name_'.$lang],
            'content'=> $lang == 'ar' ? $this->content :  $this->{"content_{$lang}"}, 
            'countries'=>$countriesName ?? [],
            'field'=>  $lang == 'fr' ? optional($this->field)->name_en : optional($this->field)->{"name_{$lang}"},
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'benefits'=> explode(',', $this['benefit_'.$lang]) ?? [],
            'requirements'=> explode(',', $this['requirement_'.$lang]) ?? [],
            'organization'=>$lang == 'ar' ? optional($this->organization)->name : optional($this->organization)->{"name_{$lang}"},           
        ];
    }
}
