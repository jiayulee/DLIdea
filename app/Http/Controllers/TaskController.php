<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Tasks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();

        $verify_data = [
            'name' => 'required',
            'category_id' => 'required',
        ];

        $validator = Validator::make($data, $verify_data);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

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
