<?php

namespace App\Http\Resources\Api\Document;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\File\FileResource;
use App\Http\Resources\Api\SchoolClass\SchoolClassResource;

class DocumentResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @param  Request  $request
   * @return array
   */
  public function toArray($request)
  {

    return [
      'id' => $this->id,
      'title' => $this->title,
      'description' => $this->description,
      'type' => $this->type,
      'state' => $this->state,
      'file' => new FileResource($this->file),
      'schoolClass' => new SchoolClassResource($this->schoolClass),
    ];
  }
}
