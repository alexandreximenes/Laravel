<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;
use Session;

class TodoController extends Controller
{

    public function __construct()
    {
        date_default_timezone_set('America/Sao_Paulo');
    }

    public function index(){
        $todo = Todo::all();
        return view('todos')->with('todos', $todo);
    }

    public function create(Request $request){

        $todo = new Todo;

        $todo->todo = $request->todo;

        $todo->save();

        Session::flash('success', 'create');

        return redirect()->back();
    }
    public function save(Request $request, $id){

        $todo = new Todo();
        $todo->id = $id;

        $todo->todo = $request->todo;

        $todo->save();

        Session::flash('success', 'save');

        return redirect()->action('TodoController@index');
    }

    public function update($id){

        $todo = Todo::find($id);

        if(!is_null($todo)){
            return view('update')->with('todo', $todo);
        }

        Session::flash('success', 'Update');

        return redirect('/todos');
    }

    public function completed($id){

        $todo = Todo::find($id);

        if(!is_null($todo)){
            $todo->completed = 1;
            $todo->save();

            Session::flash('success', 'Completed');

            return redirect()->action("TodoController@index");
        }

        Session::flash('success', 'completed');

        return redirect('/todos');
    }
    public function delete($id){
        $todo = Todo::find($id);

        if(!is_null($id)) $todo->delete();

        Session::flash('success', 'deleted');

        return redirect()->back();
    }
}
