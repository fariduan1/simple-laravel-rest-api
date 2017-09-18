<?php

namespace App\Http\Controllers;

use App\Http\Resources\Place as PlaceResource;
use Illuminate\Http\Request;
use App\Place;
use App\User;
use Tymon\JWTAuth\JWTAuth;

class PlaceController extends Controller {

  private $user;

  private $place;

  private $jwtauth;

  public function __construct(Place $place, User $user, JWTAuth $jwtauth) {
    $this->place = $place;
    $this->user = $user;
    $this->jwtauth = $jwtauth;
  }

  public function create(Request $request) {
    $the_user = $this->jwtauth->toUser($request->headers->get('token'));
    $new_place = $this->place->create([
      'name' => $request->get('name'),
      'geo_lat' => $request->get('lat'),
      'geo_lng' => $request->get('lng'),
      'user' => $the_user->id,
    ]);
    //    $new_place = new Place();
    //    $new_place->name = $request->get('name');
    //    $new_place->geo_lat = $request->get('lat');
    //    $new_place->geo_lng = $request->get('lng');
    if (!$new_place) {
      return response()->json(['failed_to_create_new_place'], 500);
    }

    //    $owner = $this->user->find($the_user->id);
    //    $new_place->user = ($owner->id);

    $new_place->save();
    return response()->json(['place_created']);
  }

  public function update(Request $request) {
    $new_place = $this->place->find($request->get('id'));
    $the_user = $this->jwtauth->toUser($request->headers->get('token'));
    if ($the_user->id == $new_place->user) {
      if ($request->get('name')) {
        $new_place->name = $request->get('name');
      }
      if ($request->get('lat')) {
        $new_place->geo_lat = $request->get('lat');
      }
      if ($request->get('lng')) {
        $new_place->geo_lng = $request->get('lng');
      }
      $new_place->update();
      return response()->json(['place_updated']);
    }

  }

  public function fetch($id) {

    return new PlaceResource(Place::find($id));

  }

  public function delete($id) {

    $new_place = $this->place->find($id);
    if ($new_place) {
      $new_place->delete();
      return response()->json(['place_removed']);
    }
    else {
      return response()->json(['place_not_found']);
    }

  }
}
