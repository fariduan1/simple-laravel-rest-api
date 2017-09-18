<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model {


  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name',
    'geo_lat',
    'geo_lng',
    'owner_id',
    'user',
  ];

  public function owner() {
    return $this->belongsTo(User::class);
  }

}
