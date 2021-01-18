<?php

namespace App\Http\Resources\Api\SchoolClass;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SchoolClassResource extends JsonResource
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
      'name' => $this->name,
    ];
  }
}
