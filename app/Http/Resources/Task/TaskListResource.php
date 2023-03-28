<?php

namespace App\Http\Resources\Task;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'priority' => $this->priority,
            'deadline' => $this->deadline,
            'description' => $this->description,
            'is_done' => $this->is_done,
            'closing_date' =>$this->closing_date
        ];
    }
}
