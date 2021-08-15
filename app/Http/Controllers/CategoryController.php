<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Tasks;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $categories = Categories::all();

        return view('question3_category', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        if(!empty($data['id'])){
            $category = Categories::find($data['id']);
            $category->update($data);
            $status = 'updated';
        }else{
            $category = Categories::create($data);
            $status = 'created';
        }

        return redirect()->route("question3")->with('success', "Category {$category->name} {$status}!");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {

        $category = Categories::find($id);
        return view("edit_category", compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

        $status = 'success';
        $using_task = Tasks::where('category_id', $id)->get();

        if($using_task->count() > 0){
            $status = 'error';
            $message = 'There is currently some task using this category.';

            return redirect()->back()->with($status, $message);
        }else{
            $category = Categories::find($id);
            $category->delete();

            $message = "Category {$category->name} deleted!";
        }

        return redirect()->route("question3")->with($status, $message);
    }
}
