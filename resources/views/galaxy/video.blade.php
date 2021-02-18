@extends('site.app')
@section('title-meta')
    <title>Galaxy </title>
@endsection

@section('content')
    @if(auth()->user())
        @include('.site.login.user.quiz.header')
        @else
        @include('.site.home-partials.header')
    @endif

@if(isset($video))
    <div class="container bg-white security">
        <div class="row p-5">
            <h1>  {{$video[0]->name}}</h1>
            <hr class="w-100">
            <video width="600" height="400" autoplay controls>
                <source src="/video/{{$video[0]->video}}"type="video/mp4">

            </video>

            </div>
        </div>
@else
    <div class="container bg-white security">
        <div class="row p-5">No video publish yet</div></div>
    @endif

@endsection



@section('scripts')
@endsection