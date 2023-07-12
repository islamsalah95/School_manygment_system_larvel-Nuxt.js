<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class showSubjectStudent extends JsonResource
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
            'name' => $this->user->name  ,  
            'email' => $this->user->email  ,  
            'Nationality' => $this->Nationality, 
            'grade' => $this->grade->name  ,  
            'classroom' => $this->classroom->name  ,  
            'section' => $this->section->name  ,
            'parent_name' => $this->parent->name,  
            'parent_email' => $this->parent->email,    
            'subjects' => $this->classroom->subject  ,  

        ];
    }
}
