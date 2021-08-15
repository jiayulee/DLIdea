@extends('shared.layout')


@section('content')
<div class="container">
    <div class="topnav" style="text-align:right;">
        <a href="{{route('question3')}}">Back to Task</a>
    </div>
</div>
<div class="container">
    <h1>Category List <button class="btn btn-sm btn-primary" type="button" data-toggle="modal" data-target="#categoryModal">Create Category</button></h1>
    @if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
    @elseif (\Session::has('error'))
    <div class="alert alert-danger">
        <ul>
            <li>{!! \Session::get('error') !!}</li>
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
            <th width="70%">Category</th>
            <th width="20%">Action</th>
        </thead>
        <tbody>
            @forelse($categories as $i => $category)
            <tr>
                <td>{{$i+1}}</td>
                <td>{{$category->name}}</td>
                <td>
                    <a class="btn btn-sm btn-info editbtn" href="{{route('category.edit', $category->id)}}"><i class="fa fa-edit"></i></a>
                    <button class="btn btn-sm btn-danger deletebtn" href="{{route('category.destroy', $category->id)}}"><i class="fa fa-trash"></i></button>
                </td>
            </tr>
            @empty
            <tr>
                <td></td>
                <td>No category found.</td>
                <td>
                    <button class="btn btn-sm btn-primary" type="button" data-toggle="modal" data-target="#categoryModal">Create Category</button>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

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
            text: 'This category record will be deleted!',
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
