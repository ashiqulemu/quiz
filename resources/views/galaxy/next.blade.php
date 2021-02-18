@extends('site.qapp')
@section('title-meta')
    <title>Quiz</title>
@endsection

@section('content')
    @include('site.home-partials.quiz-header')
    @include('galaxy.quiz-button')
    @include('galaxy.nextquiz')

@endsection
@section('scripts')
@endsection