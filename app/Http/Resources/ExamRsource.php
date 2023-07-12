<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExamRsource extends JsonResource
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
            "id"=>  $this->id,
            "name"=> $this->name,
            "subject_id"=>  $this->subject_id,
            "subjects"=> [
                "id"=>  $this->id,
                "name"=> $this->subjects->name,
                "classroom"=> $this->subjects->classroom->name,
                "grade"=> $this->subjects->classroom->grade->name,
            ]

        ]; 
    }
}
