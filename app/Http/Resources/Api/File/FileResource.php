<?php

namespace App\Http\Resources\Api\File;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FileResource extends JsonResource
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
      'originalName' => $this->originalName,
      'mimetype' => $this->mimetype,
      'size' => $this->size,
      'key' => $this->key,
      'url' => $this->url,
      'url_download' => $this->url_download,
    ];
  }
}
