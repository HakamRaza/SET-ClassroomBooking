<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClassroomResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'topic' => $this->name,
            // access from relation 'teacher'
            'teacher_name' => $this->teacher->name,
            // access from relation 'classroomType'
            'category_name' => $this->classroomType->type,
            'date' => $this->date,
            'time' => $this->time_start . " to " . $this->time_end
        ];
    }
}
