<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentinfoRsource extends JsonResource
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
                'student' => [
                    'name' => $this->student->name,
                    'id' => $this->student->id,
                ],
                'grade' => [
                    'name' => $this->grade->name,
                    'id' => $this->grade->id,
                ],
                'classroom' => [
                    'name' => $this->classroom->name,
                    'id' => $this->classroom->id,
                ],
                'section' => [
                    'name' => $this->section->name,
                    'id' => $this->section->id,
                ],
                'parent' => [
                    'name' => $this->parent->name,
                    'id' => $this->parent->id,
                ],
                'Nationality' => $this->Nationality

        ];
    }

}
