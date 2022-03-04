@extends('layouts.app')
@section('content')
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    @forelse ($photos as $p)
    <div class="carousel-item @if ($loop->index == 0) active @endif">
      <img src="{{URL::asset('storage/'.$p->photo)}}" class="d-block w-100" alt="{{$p->title}}">
      <p style="background: black; color:yellow;" class="text-center">{{$p->title}}</p>
    </div>
    @empty
    <div class="carousel-item active ">
      <img src="{{URL::asset('images/banner.jpg')}}" class="d-block w-100" alt="es una imagen de banner">
    </div>
    @endforelse
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only"></span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only"></span>
  </a>
</div>
@endsection
