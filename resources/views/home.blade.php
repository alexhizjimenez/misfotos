@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="row">
      @forelse ($photos as $p )
      <div class="col-md-4 my-2">
        <div class="card">
          <img class="card-img-top" src="{{URL::asset('storage/'.$p->photo)}}" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title">{{$p->title}}</h5>
            <p class="card-text">{{$p->description}}
            </p>
            <button type="button" class="btn btn-danger deleteFoto" data-id="{{$p->id}}">{{__('forms.delete')}}</button>
            <button type="button" class="btn {{$p->status ? 'btn-warning':'btn-primary'}} statusFoto"
              data-id="{{$p->id}}">@if ($p->status)
              {{__('forms.inactive')}}
              @else
              {{__('forms.active')}}
              @endif</button>
            <a href="{{route('edit-form-foto',$p)}}" class="btn btn-success">{{__('forms.update')}}</a>
          </div>
          <div class="card-footer text-muted">
            {{__('forms.category')}}: {{$p->category->name}} --- {{$p->date}}
          </div>
        </div>
      </div>
      @empty
      <h1>No tiene ninguna imagen</h1>
      @endforelse
    </div>

  </div>
</div>
@endsection
@section('scripts')
<script src="{{URL::asset('js/admin/actionsFoto.js')}}"></script>
@endsection
