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
    <table class="tabe table-bordered" id="users-table">
        <thead>
            <th>Id</th>
            <th>Name</th>
            <th>Complete Task</th>
        </thead>
    </table>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{route("question1.data")}}',
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'task_count',
                    name: 'complete task'
                },
            ],
            "order": [
                [2, "desc"]
            ],
        });
    });
</script>
@endsection
