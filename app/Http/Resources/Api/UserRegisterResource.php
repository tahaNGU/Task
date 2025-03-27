<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserRegisterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name'=>$this['name'],
            'last_name'=>$this['lastname'],
            'email'=>$this['email'],
            'created_at'=>$this['created_at'],
            'token'=>$this['token']
        ];
    }
}
