<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TeacherResource extends JsonResource
{
    public function getVar()
    {
        return "Hai";
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $var = \Illuminate\Support\Str::random(10); // generate random string

        return [
            "full_name" => $this->name,
            "created_at_original" => $this->created_at,
            "created_at_formatted" => $this->created_at->format('Y-m-d'),
            // conditional to attach data
            "created_at_exist" => $this->when(isset($this->data), function(){
               return "It exist in teacher";
            }),
            "created_at_false" => $this->when(false, function(){
               return "It exist in teacher";
            }),
            // $this->mergeWhen()
            "random_var" => $var,
            "random_var2" => $this->getVar(),
            "pass_data" => $this->when(isset($this->pass_data), function(){
                return $this->pass_data;
             }, "No Pass"),
        ];

        // return parent::toArray($request);
    }
}
