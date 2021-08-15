@extends('shared.layout')


@section('content')
<div class="container">
    <div class="topnav" style="text-align:right;">
        <a href="{{route('category.list')}}">Back</a>
    </div>
</div>
<div class="container">
    <h1>Edit {{$category->name}}</h1>
    @if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
    @endif
</div>
<div class="container">
    <form class="form" method="POST" action="{{ route('category.create') }}">
        @csrf
        <input name="id" value="{{$category->id}}" hidden>
        <label for="category">Name :</label>
        <input class="form-control" id="category" name="name" value="{{$category->name}}">
        <br>
        <button type="submit" class="btn btn-primary">Update</button>
        </form>
</div>

</div>
@endsection
