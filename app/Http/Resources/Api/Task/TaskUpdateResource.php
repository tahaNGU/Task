<?php

namespace App\Http\Resources\Api\Task;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskUpdateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title'=>$this['title'],
            'note'=>$this['note'],
            'status'=>$this['status'],
            'finished_at'=>$this['finished_at'],
            'created_at'=>$this['created_at']
        ];
    }
}
