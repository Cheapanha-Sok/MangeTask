<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function show($id){
        return response()->json(Task::findOrfail($id));
    }
    public function all(){
        return response()->json(Task::all());
    }
    public function store(Request $request) : RedirectResponse{
        $validated = $request->validate([
            'title' => 'required',
            'description'=>'required',
            'long_description'=>'required'
        ]);
        $task = new Task;
        $task->title = $validated['title'];
        $task->description = $validated['description'];
        $task->long_description = $validated['long_description'];
        $task->save();
        return redirect()->route('api/tasks.get')->with('success','create task success');
    }
    public function update(Request $request, $id) : RedirectResponse{
        $task = Task::findOrfail($id);

        if($request['title'] != '' ){
            $task->title = $request['title'];
        }
        if($request['description'] != '' ){
            $task->description = $request['description'];
        }
        if($request['long_description'] != '' ){
            $task->long_description = $request['long_description'];
        }
        if($request['completed'] != null){
            $task->completed = $request['completed'];
        }
        $task->save();
        return redirect()->route('tasks.get')->with('success','updated task success');
    }
    public function destroy($id) : RedirectResponse{
        $task = Task::findOrfail($id);
        if($task->delete()){   
            return redirect()->route('tasks.get')->with('success','Task remove success');
        }
        return response()->isNotFound();
    }
}
