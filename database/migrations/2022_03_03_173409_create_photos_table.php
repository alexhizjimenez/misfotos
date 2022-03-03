<?php

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhotosTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('photos', function (Blueprint $table) {
      $table->id();
      $table->string('title');
      $table->text('description');
      $table->date('date');
      $table->text('photo');
      $table->boolean('status')->default(1);
      $table->foreignIdFor(Category::class);
      $table->foreignIdFor(User::class);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('photos');
  }
}
