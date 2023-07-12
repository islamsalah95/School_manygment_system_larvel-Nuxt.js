<?php

namespace App\Http\Resources;

use App\Models\Grade;
use Illuminate\Http\Resources\Json\JsonResource;

class ClassromResourceSecond extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'classroom_id' =>$this->classroom_id,
            'classroom' =>[
                'id'=>$this->classroom->id,
                'name'=>$this->classroom->name,
                'grade_id'=>$this->classroom->grade_id,
                'grade_name'=>$this->classroom->grade->name,

            ] ,
        ];   
    
    }
}



