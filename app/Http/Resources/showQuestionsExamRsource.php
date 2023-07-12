<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class showQuestionsExamRsource extends JsonResource
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
            "id"=>  $this-> id,
            "question"=>  $this->question,
            "A"=>  $this-> A,
            "B"=>  $this-> B,
            "C"=>  $this-> C,
            "D"=>  $this-> D,
            "correct"=>  $this-> correct,
            "score"=>  $this->score,
            "exam_id"=>  $this-> exam_id
        ]; 
    }
}
