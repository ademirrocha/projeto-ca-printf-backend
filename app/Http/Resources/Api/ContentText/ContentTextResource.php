<?php

namespace App\Http\Resources\Api\ContentText;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\File\FileResource;

class ContentTextResource extends JsonResource
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
      'content' => $this->content,
      $this->content => $this->text,
      'type' => $this->type,
      'file' => new FileResource($this->file),
    ];
  }
}
