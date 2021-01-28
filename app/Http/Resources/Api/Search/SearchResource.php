<?php

namespace App\Http\Resources\Api\Search;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\File\FileResource;
use App\Http\Resources\Api\SchoolClass\SchoolClassResource;
class SearchResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @param  Request  $request
   * @return array
   */
  public function toArray($request)
  {

    $resource = [];

    if($this->typeSearched == 'projects'){
      $resource = [
        'id' => $this->id,
        'title' => $this->title,
        'description' => $this->description,
        'state' => $this->state,
        'image' => new FileResource($this->file),
        'typeSearched' => $this->typeSearched
      ];
    }

    if($this->typeSearched == 'events'){
      $resource = [
        'id' => $this->id,
        'title' => $this->title,
        'description' => $this->description,
        'initial_date' => $this->initial_date,
        'final_date' => $this->final_date,
        'state' => $this->state,
        'typeSearched' => $this->typeSearched
      ];
    }

    if($this->typeSearched == 'documents'){

      

      $resource = [
        'id' => $this->id,
        'title' => $this->title,
        'description' => $this->description,
        'type' => $this->type,
        'state' => $this->state,
        'file' => new FileResource($this->file),
        'schoolClass' => new SchoolClassResource($this->schoolClass),
        'typeSearched' => $this->typeSearched
      ];
    }

    return $resource;
  }
}
