<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Tasks;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();

        if(!empty($data['id'])){
            $category = Tasks::find($data['id']);
            $category->update($data);
            $status = 'updated';
        }else{
            $category = Tasks::create($data);
            $status = 'created';
        }

        return redirect()->route("question3")->with('success', "Task {$category->name} {$status}!");

    }

    public function edit(Request $request, $id)
    {

        $task = Tasks::find($id);
        $categories = Categories::all();

        return view("edit_task", compact('task', 'categories'));
    }

    public function destroy(Request $request, $id)
    {
        $task = Tasks::find($id);
        $task->delete();

        return redirect()->route("question3")->with('success', "Task {$task->name} deleted!");
    }
}
