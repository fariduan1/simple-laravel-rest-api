<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Place extends Resource {

  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request
   *
   * @return array
   */
  public function toArray($request) {
    return [
      'id' => $this->id,
      'name' => $this->name,
      'lat' => $this->geo_lat,
      'lng' => $this->geo_lng,
      'owner_id' => $this->user,
      'created_at' => $this->created_at,
      'updated_at' => $this->updated_at,
    ];
  }
}
