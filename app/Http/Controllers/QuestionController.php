<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Tasks;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use DataTables;

class QuestionController extends Controller
{
    public $name = "DL Ideas";

    public function question1(Request $request)
    {
        // dd(static::FuncQ1Data($request));
        return view('question1');
    }

    public static function FuncQ1Data(Request $request)
    {
        $user_url = "https://jsonplaceholder.typicode.com/users";
        $todo_url = "https://jsonplaceholder.typicode.com/todos";

        $user_client = new Client();
        $todo_client = new Client();

        $user_respond = $user_client->get($user_url);
        $todo_respond = $todo_client->get($todo_url);

        $user_content = (string) $user_respond->getBody();
        $todo_content = (string) $todo_respond->getBody();

        $userJson = preg_replace("/\r|\n/", "", $user_content);
        $userArr = json_decode("{$userJson}", true);
        $todoJson = preg_replace("/\r|\n/", "", $todo_content);
        $todoArr = json_decode("{$todoJson}", true);

        $userObj = collect($userArr);

        $todoObj = collect($todoArr);

        $todoObjCompleted = $todoObj->filter(function ($value, $key) {
            return $value['completed'];
        });
        $todoObjNotCompleted = $todoObj->filter(function ($value, $key) {
            return !$value['completed'];
        });

        $todoObjGroup = $todoObjCompleted->groupBy('userId');

        $user = $todoObjGroup->map(function ($item, $key) use ($userObj) {
            $user = $userObj->firstWhere('id', $key);
            $user['task_count'] = $item->count();
            return $user;
        })->sortByDesc('task_count');

        $datatables = Datatables::of($user)->make(true);

        return $datatables;
    }

    public function api_todo(Request $request)
    {

        $data = $request->all();
        $todo_url = "https://jsonplaceholder.typicode.com/todos";

        $todo_client = new Client();
        $todo_respond = $todo_client->get($todo_url);
        $todo_content = (string) $todo_respond->getBody();
        $todoJson = preg_replace("/\r|\n/", "", $todo_content);
        $todoArr = json_decode("{$todoJson}", true);
        $todoObj = collect($todoArr);
        $status = 1;
        $filter_data = null;
        $message = 'Success';

        if (!empty($data)) {
            foreach ($data as $filter => $value) {
                if($value == 'false'){
                    $value = false;
                }
                $filter_data =  $todoObj->where($filter, $value);
            }
        }else{
            $filter_data = $todoObj;
        }

        if($filter_data->count() < 1){
            $status = 0;
            $message = 'No record was found';
        }

        $response = ['status' => $status, 'message' => $message, 'data' => $filter_data];

        return response()->json($response);
    }

    public function Q1Data(Request $request)
    {
        return static::FuncQ1Data($request);
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function question2()
    {
        // $arg ="DL Ideas";
        // $message = "Hello {$arg}. Nice to meet you,";

        $name = $this->getName();
        return view('question2', compact('name'));
    }

    public function question3()
    {

        $tasks = Tasks::all();
        $categories = Categories::all();
        return view('question3_task', compact('tasks', 'categories'));
    }
}
