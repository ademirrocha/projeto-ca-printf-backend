<?php

namespace App\Http\Resources\Api\Project;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\File\FileResource;

class ProjectResource extends JsonResource
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
      'state' => $this->state,
      'image' => new FileResource($this->file)
    ];
  }
}
