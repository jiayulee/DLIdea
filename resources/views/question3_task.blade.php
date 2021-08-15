@extends('shared.layout')


@section('content')
<div class="container">
    <div class="topnav" style="text-align:right;">
    <a href="{{route('question1.list')}}">Question 1</a>
        <a href="{{route('question2')}}">Question 2</a>
        <a href="{{route('question3')}}">Question 3</a>
    </div>
</div>
<div class="container">
    <h1>Task List  <button class="btn btn-sm btn-primary" type="button" data-toggle="modal" data-target="#taskModal">Create Task</button>
    <a class="btn btn-sm btn-info" type="button" href="{{route('category.list')}}">View Categories</a>
    </h1>
    @if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
    @endif

    @foreach ($errors->all() as $error)
    <div class="alert alert-danger">{{ $error }}</div>
    @endforeach
</div>
<div class="container">
    <table class="table table-striped">
        <thead>
            <th width="10%">No</th>
            <th width="35%">Task</th>
            <th width="35%">Category</th>
            <th width="20%">Action</th>
        </thead>
        <tbody>
            @forelse($tasks as $i => $task)
            <tr>
                <td>{{$i+1}}</td>
                <td>{{$task->name}}</td>
                <td>{{$task->category->name}}</td>
                <td>
                    <a class="btn btn-sm btn-info" href="{{route('task.edit', $task->id)}}"><i class="fa fa-edit"></i></a>
                    <a class="btn btn-sm btn-danger deletebtn" href="{{route('task.destroy', $task->id)}}"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
            @empty
            <tr>
                <td></td>
                <td>No task found. </td>
                <td>No category found.</td>
                <td>
                    <button class="btn btn-sm btn-primary" type="button" data-toggle="modal" data-target="#taskModal">Create Task</button>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    @include('modal.modal_task')
    @include('modal.modal_category')
</div>

@endsection

@section('js')
<script>
    $('.deletebtn').on('click', function(event) {
        event.preventDefault();
        var url = $(this).attr('href');

        swal({
            title: 'Are you sure?',
            text: 'This category task will be deleted!',
            icon: 'warning',
            buttons: ["Cancel", "Yes!"],
        }).then((result) => {
            if (result) {
                window.location.href = url;
            }
        });
    });
</script>
@endsection
