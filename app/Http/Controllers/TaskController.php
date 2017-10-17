<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\User;
use App\Http\Requests;

class TaskController extends Controller
{
    protected $tasks;
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request){
        $tasks = Task::where('user_id', $request->user()->id)->get();

        return view('tasks.index', [
            'tasks' => $tasks,
        ]);

        //return view('tasks.index');
    }
    public function store(Request $request)
    {
        
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $request->User()->tasks()->create([
            'name' => $request->name,
        ]);

        return redirect('/tasks');
    }
}
