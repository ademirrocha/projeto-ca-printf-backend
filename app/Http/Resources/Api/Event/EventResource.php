<?php

namespace App\Http\Resources\Api\Event;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
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
      'initial_date' => $this->initial_date,
      'final_date' => $this->final_date,
      'state' => $this->state,
    ];
  }
}
