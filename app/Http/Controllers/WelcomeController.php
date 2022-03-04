<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
  public function index()
  {
    $photos = Photo::where('status', '=', '1')->latest()
      ->take(10)
      ->get();
    return view('welcome', compact('photos'));
  }
}
