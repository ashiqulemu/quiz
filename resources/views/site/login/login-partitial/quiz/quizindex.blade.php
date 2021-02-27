@extends('site.app')
@section('title-meta')
    <title>Glaxy User Logged in </title>
@endsection

@section('content')

    @include('site.login.login-partitial.quiz.quiz_loggedin_header')
    @include('site.login.login-partitial.quiz.quiz-button')
    <br>
    
    @include('site.login.login-partitial.quiz.loggedin_quiz')




@endsection



@section('scripts')
@endsection

