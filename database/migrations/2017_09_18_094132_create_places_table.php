<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlacesTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('places', function (Blueprint $table) {
      $table->increments('id');
      $table->char('name');
      $table->float('geo_lat');
      $table->float('geo_lng');
      $table->integer('user')->unsigned()->nullable();
      $table->foreign('user')->references('id')->on('users');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('places');
  }
}
