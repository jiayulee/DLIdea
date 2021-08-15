@extends('shared.layout')


@section('content')
<div class="container">
    <div class="topnav" style="text-align:right;">
        <a href="{{route('question1.list')}}">Question 1</a>
        <a href="{{route('question2')}}">Question 2</a>
        <a href="{{route('question3')}}">Question 3</a>
    </div>
    <h1>Hello {{$name}}, Nice to meet you</h1>
</div>
@endsection
