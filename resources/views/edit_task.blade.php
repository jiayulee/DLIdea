@extends('shared.layout')


@section('content')
<div class="container">
    <div class="topnav" style="text-align:right;">
        <a href="{{route('category.list')}}">Back</a>
    </div>
</div>
<div class="container">
    <h1>Edit {{$task->name}}</h1>
    @if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
    @endif
</div>
<div class="container">
    <form class="form" method="POST" action="{{ route('task.create') }}">
        @csrf
        <input name="id" value="{{$task->id}}" hidden>
        <label for="task">Name :</label>
        <input class="form-control" id="task" name="name" value="{{$task->name}}">
        <br>
        <label for="category">Category Name :</label>
            <select class="form-control" id="category" name="category_id" required>
                @foreach($categories as $category)
                <option value="{{$category->id}}" {{ $task->category_id == $category->id ? 'selected' : ' ' }}>{{$category->name}}</option>
                @endforeach
            </select>
            <br>
        <button type="submit" class="btn btn-primary">Update</button>
        </form>
</div>

</div>
@endsection
