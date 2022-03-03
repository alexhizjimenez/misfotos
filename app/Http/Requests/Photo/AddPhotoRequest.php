<?php

namespace App\Http\Requests\Photo;

use Illuminate\Foundation\Http\FormRequest;

class AddPhotoRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'title' => 'required|unique:photos,title',
      'description' => 'required',
      'photo' => 'required|mimes:jpg,png|dimensions:max_width=300,max_height=200',
      'category_id' => 'required',
      'user_id' => 'required',
    ];
  }
  public function messages()
  {
    return [
      'title.required' => __('requests.titleRequired'),
      'title.unique' => __('requests.titleUnique'),
      'description.required' => __('requests.descriptionRequired'),
      'photo.required' => __('requests.photoRequired'),
      'photo.dimensions' => __('requests.photoDimensions'),
      'photo.mimes' => __('requests.photoMimes'),
      'category_id.required' => __('requests.category_idRequired'),
      'user_id.required' => __('requests.user_idRequired'),
    ];
  }
}
