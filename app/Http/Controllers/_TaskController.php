<?php

namespace App\Http\Controllers\Controller;
use App\Models\_Task;
use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;


class _TaskController extends Controller
{
    // to get all tasks
    public function index()
    {
    $task = _Task::all();
    if($task->count>0){
    return response()-> json([
        'status'=> 200,
        'task'=> $task
    ],200);
    }else {
    return response()-> json([
      'status'=> 404,
      'task'=> 'Task not found'
    ],404);
    }
}
//  to create new task
public function store(Request $request)
{
    // to ensure the fields are not empty
    $validator = Validator::make($request->all(),[
        'title'=> 'required|max50',
        'description'=> 'required|max255',
        'status'=> 'required|max255'
    ]);
    // if any field is empty or incorrect it will bounce the back
    if($validator->fails()){
        return response()->json([
            'status'=> 422,
            'errors'=> $validator->messages()
        ],422);
    }else{
        // to create new task
        $task = _Task::create([
            'title'=> $request->title,
            'description'=>$request->description,
            'status'=>$request->status
        ]);
    }
    if($task){
        return response()->json([
            'status'=> 200,
            'message'=> 'Task created successfully'
        ]);
    }else {
       return response()->json([
            'status'=> 500,
            'message'=> 'Something went wrong!'
       ],500);
       }
}
// to get a single task
public function show($id)
{
    $task= _Task::find($id);
    if($task){
        return response()->json([
            'status'=> 200,
            'task'=> $task
        ]);
    }else {
       return response()->json([
            'status'=> 404,
            'message'=> 'No such task found!',
            'data' => $task
       ],404);
       }
}
// to delete a task
public function destroy( $id)
    {
        $task=_Task::find($id);
        if($task){
          $task->delete();
  }else{
    return response()->json([
            "status" => 404,
            "message" => "Task deleted successfully.",
            "data" => $task
        ],404); 
        }
        
    }
    // edit a task
public function edit($id)
    {
      $task= _Task::find($id);
    if($task){
        return response()->json([
            'status'=> 200,
            'task'=> $task
        ]);
    }else {
       return response()->json([
            'status'=> 404,
            'message'=> 'No such task found!'
       ],404);
       }  
    }
    // to update any task field 
public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(),[
        'title'=> 'required|max50',
        'description'=> 'required|max300',
        'status'=> 'required|max255'
    ]);
    if($validator->fails()){
        return response()->json([
            'status'=> 422,
            'errors'=> $validator->messages()
        ],422);
    }else{
        $task = _Task::find($id);
        
    }
    if($task){
        $task->update([
            'title'=> $request->title,
            'description'=>$request->description,
            'status'=>$request->status
        ]);
        return response()->json([
            'status'=> 200,
            'message'=> 'Task updated successfully'
        ]);
    }else {
       return response()->json([
            'status'=> 404,
            'message'=> 'No such task found!'
       ],500);
       }
    }
}
    // pagination
 