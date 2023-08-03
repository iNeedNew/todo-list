<?php

namespace App\Http\Resources\Api\Task;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
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
            'description' => $this->description,
            'parent_id' => $this->parent_id,
            'status' => $this->status,
            'priority' => $this->priority,
            'completed_at' => $this->completed_at,
            'created_at' => $this->created_at,
        ];
    }
}
