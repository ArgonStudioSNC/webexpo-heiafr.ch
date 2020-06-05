<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Project extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
     public function toArray($request)
     {
         return [
             'id' => $this->id,
             'degree' => $this->degree,
             'year' => $this->year,
             'student' => $this->student,
             'site' => $this->site,
             'professor' => $this->professor,
             'workshop' => $this->workshop,
             'experts' => $this->experts,
             'title' => $this->title,
             'lead' => $this->lead,
             'text' => $this->text,
         ];
     }
 }
