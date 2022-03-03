@extends('layouts.app')
@section('content')
<div class="container">
  <div class="col-md-6 mx-auto">
    <div class="card">
      <div class="card-body">
        <form id="formFotos" name="formFotos" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="form-group">
            <label for="title">{{__('forms.title')}}</label>
            <input type="text" class="form-control" value="{{old('title',$photo->title)}}" id="title" name="title"
              placeholder="">

          </div>
          <div class="form-group">
            <label for="description">{{__('forms.description')}}</label>
            <input type="text" class="form-control" value="{{old('description',$photo->description)}}" id="description"
              name="description">

          </div>
          <div class="form-group">
            <label for="photo">{{__('forms.photo')}}</label>
            <input type="file" name="photo" class="form-control" id="photo">
            <img src="{{URL::asset('/storage/'.$photo->photo)}}" class="img-fluid " alt="">
          </div>
          <div class="form-group">
            <label for="category">{{__('forms.category')}}</label>
            <select name="category_id" id="category_id" class="form-control">
              @forelse ($categories as $c)
              <option {{$c->id == $photo->category_id ? 'selected':'' }} value="{{$c->id}}">{{$c->name}}
              </option>
              @empty
              <option disabled selected>{{__('forms.notfound')}}</option>
              @endforelse
            </select>
          </div>
          <input type="hidden" id="user_id" name="user_id" value="{{Auth::id()}}">
          <hr>
          <button type="submit" id="update" class="btn btn-primary"
            data-id="{{$photo->id}}">{{__('forms.update')}}</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
@section('scripts')
<script src="{{URL::asset('js/admin/editFoto.js')}}"></script>
@endsection
