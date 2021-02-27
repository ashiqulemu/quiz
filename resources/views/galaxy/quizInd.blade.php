@extends('site.qapp')
@section('title-meta')
    <title>Quiz</title>
@endsection

@section('content')
    @include('galaxy.top-header')
    @include('galaxy.quiz-button')
{{--    @include('site.home-partials.quizTest')--}}
    @include('quiz.quizTest')

@endsection
@section('scripts')
@endsection