<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Photo\AddPhotoRequest;
use App\Http\Requests\Photo\UpdatePhotoRequest;
use App\Models\Photo;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;


class PhotoController extends Controller
{

  public function store(AddPhotoRequest $request)
  {
    if ($request->ajax()) {
      try {
        DB::transaction(function () use ($request) {
          $pathPhoto = '';
          if ($request->file('photo')) {

            $pathPhoto = $request->photo->store('photos');
            $img = Image::make(storage_path() . '/app/public/' . $pathPhoto);
            $img->resize(1024, 300);
            $img->save(storage_path() . '/app/public/' . $pathPhoto);
          }
          $photo = new Photo();
          $photo->title = $request->title;
          $photo->description = $request->description;
          $photo->category_id = $request->category_id;
          $photo->date = Carbon::now();
          $photo->user_id = $request->user_id;
          $photo->photo = $pathPhoto;
          $photo->save();
        });
        return response()->json(['success' => true, 'message' => __('message.add')]);
      } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()]);
      }
    }
  }

  public function show($id)
  {
    //
  }

  public function destroy(Request $request, $id)
  {
    if ($request->ajax()) {
      $photo = Photo::find($id);
      if ($photo) {
        $image_path = public_path() . "/storage/" . $photo->photo;

        if (File::exists($image_path)) File::delete($image_path);
        if ($photo->delete()) {
          return response()->json([
            'success' => true,
            'message' => __('message.destroy')
          ]);
        } else {
          return response()->json([
            'success' => false,
            'message' => __('message.itemRelation')
          ]);
        }
      } else {
        return response()->json([
          'success' => false,
          'message' => __('message.notFound')
        ]);
      }
    }
  }
  public function status(Request $request, $id)
  {
    if ($request->ajax()) {
      $photo = Photo::find($id);
      if ($photo) {
        if ($photo->status) {
          $photo->status = 0;
        } else {
          $photo->status = 1;
        }
        $photo->save();
        return response()->json([
          'success' => true,
          'message' => __('message.update')
        ]);
      } else {
        return response()->json([
          'success' => false,
          'message' => __('message.notFound')
        ]);
      }
    }
  }

  public function updated(UpdatePhotoRequest $request)
  {
    if ($request->ajax()) {
      $photo = Photo::find($request->id);
      if ($photo) {
        if ($request->file('photo')) {
          $pathPhoto = $request->photo->store('photos');
          $img = Image::make(storage_path() . '/app/public/' . $pathPhoto);
          $img->resize(1024, 300);
          $img->save(storage_path() . '/app/public/' . $pathPhoto);
          $image_path = public_path() . "/storage/" . $photo->photo;
          if (File::exists($image_path)) File::delete($image_path);
          $photo->photo = $pathPhoto;
        }
        $photo->title = $request->title;
        $photo->description = $request->description;
        $photo->category_id = $request->category_id;
        $photo->date = Carbon::now();
        $photo->user_id = $request->user_id;
        $photo->save();

        return response()->json(['success' => true, 'message' => __('message.update')]);
      } else {
        return response()->json([
          'success' => false,
          'message' => __('message.notFound')
        ]);
      }
    }
  }
}
