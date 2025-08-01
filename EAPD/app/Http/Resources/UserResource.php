<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name'=>$this->name(),
            'email'=>$this->email,
            'phone'=>$this->phone_number,
            'nationality'=>getCountry($this->nationality),
            'address'=>$this->address,
            'token'=>$this->token
        ];
    }
}
