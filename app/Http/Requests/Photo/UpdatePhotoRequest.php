<?php

namespace App\Http\Requests\Photo;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePhotoRequest extends FormRequest
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
      'title' => 'required|unique:photos,title,' . $this->id,
      'description' => 'required',
      'photo' =>      'nullable|mimes:jpg,png|dimensions:min_width=400,min_height=300',
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
      'photo.mimes' => __('requests.photoMimes'),
      'photo.dimensions' => __('requests.photoDimensions'),
      'category_id.required' => __('requests.category_idRequired'),
      'user_id.required' => __('requests.user_idRequired'),
    ];
  }
}
