<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
  public function index()
  {
    $categories = Category::all();
    return view('admin.formFotos.form', compact('categories'));
  }

  public function edit($id)
  {
    $photo = Photo::find($id);
    $categories = Category::all();
    return view('admin.formFotos.edit', compact('photo', 'categories'));
  }
}
