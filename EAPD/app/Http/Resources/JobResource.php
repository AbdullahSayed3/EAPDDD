<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobResource extends JsonResource
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
       
       if($this->country_id)
        {
            // $countrieIds = unserialize($this->countries);
            $countriesName = \App\Models\Country::whereIn('code', $this->country_id)->pluck('name_'.$lang)->toArray(); 
        }
        return [
            'id'=>$this->id,
            'name'=> $this->name,
            'content'=> $this->content,
            'country'=> $countriesName,
            'tags'=>  explode(',', $this->tags),
            'start_date'=> $this->start_date,
            'end_date'=> $this->end_date,
            'image' => $this->image ? asset('uploads/jobs_file/' . $this->image) : null,
            'images'=> $this->images->map(function ($image) {
                return asset('uploads/jobs_file/' . $image->image);
            })->toArray(),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'requirements'=> $this->requirements ? explode(',', $this->requirements) : [],
            'benefits'=> $this->benefit ? explode(',', $this->benefit) : [],
            'type'=>$this->job_type_id,
            'type_name'=>$this->jobType ? $this->jobType['name_'.$lang] : null,
        ];
    }
}
