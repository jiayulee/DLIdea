<div class="modal fade" id="taskModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
  <form class="form" method="POST" action="{{ route('task.create') }}">
        @csrf
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create Task</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <label for="task">Task Name:</label>
            <input class="form-control" id="task" name="name">
            <label for="category">Category Name :</label>
            <select class="form-control" id="category" name="category_id" required>
                @forelse($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
                @empty
                <option value="" readonly>You are require to create Category first</option>
                @endforelse
            </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </div>
  </form>
  </div>
</div>
