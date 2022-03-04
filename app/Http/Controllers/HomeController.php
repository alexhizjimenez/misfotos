<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {
    $photos = Photo::where('user_id', '=', Auth::id())->get();
    return view('home', compact('photos'));
  }

  public function getLocale($locale)
  {
    session()->put('locale', $locale);
    return Redirect::back();
  }
}
