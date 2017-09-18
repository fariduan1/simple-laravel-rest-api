<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException as JWTAuthException;

class UserController extends Controller {

  private $user;

  private $jwtauth;

  public function __construct(User $user, JWTAuth $jwtauth) {
    $this->user = $user;
      $this->jwtauth = $jwtauth;
  }

  public function getRegister(Request $request) {
    $newUser = $this->user->create([
      'name' => $request->get('name'),
      'email' => $request->get('email'),
      'password' => bcrypt($request->get('password')),
    ]);
    if (!$newUser) {
      return response()->json(['failed_to_create_new_user'], 500);
    }
    return response()->json([
      'token' => $this->jwtauth->fromUser($newUser),
    ]);
  }

  public function getLogin(Request $request) {


    // get user credentials: email, password
    $credentials = $request->only('name', 'password');
    $token = NULL;
    try {
      $token = $this->jwtauth->attempt($credentials);
      if (!$token) {
        return response()->json(['invalid_name_or_password'], 422);
      }
    } catch (JWTAuthException $e) {
      return response()->json(['failed_to_create_token'], 500);
    }
    return response()->json(compact('token'));
  }

  public function getLogout() {

  }
}
