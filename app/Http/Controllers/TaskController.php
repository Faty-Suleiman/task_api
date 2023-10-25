<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Task;


class TaskController extends Controller
{
    // to get all tasks
    public function index()
{
    $user = auth('sanctum')->user();

   // Check if the user is authenticated
    if (!$user) {
        return response()->json([
            'status' => 401,
            'message' => "Unauthorized"
        ], 401);
    }
    $tasks = Task::all();
    
    if ($tasks->count() > 0) {
        return response()->json([
            'status' => 200,
            'tasks' => $tasks,
        ], 200);
    } else {
        return response()->json([
            'status' => 404,
            'message' => 'No tasks found',
        ], 404);
    }
}
//  to create new task
public function store(Request $request)
{

    // $user = Auth::user();
     $user = auth('sanctum')->user();

   // Check if the user is authenticated
    if (!$user) {
        return response()->json([
            'status' => 401,
            'message' => "Unauthorized"
        ], 401);
    }


    // Validate the request data
    $validator = Validator::make($request->all(), [
        'title' => 'required',
        'description' => '',
        'status' => 'required|in:pending,in_progress,completed'
    ]);

    // If validation fails, return validation errors
    if ($validator->fails()) {
        return response()->json([
            'status' => 422,
            'errors' => $validator->messages()
        ], 422);
    }

    // Create a new task and associate it with the authenticated user
    $task = Task::create([
        'title' => $request->title,
        'description' => $request->description,
        'status' => $request->status,
        'user_id' => $user->id
    ]);

    // Return a JSON response based on the result of task creation
    if ($task) {
        return response()->json([
            'status' => 201,
            'message' => 'Task created successfully'
        ], 201);
    } else {
        return response()->json([
            'status' => 500,
            'message' => 'Something went wrong!'
        ], 500);
    }
}


 // to get a single task
 public function show($id)

 {
    $user = auth('sanctum')->user();
    if (!$user) {
        return response()->json([
            'status' => 401,
            'message' => "Unauthorized"
        ], 401);
    }
    $task= Task::find($id);
    if($task){
        return response()->json([
            'status'=> 200,
            'task'=> $task,
            
        ]);
    }else {
      return response()->json([
           'status'=> 404,
           'message'=> 'No such task found!',
           'data' => null
      ],404);
      }
 }

// // to delete a task
 public function destroy( $id)
     {
        $user = auth('sanctum')->user();
    if (!$user) {
        return response()->json([
            'status' => 401,
            'message' => "Unauthorized"
        ], 401);
    }
        $task=Task::find($id);
        if($task){
          $task->delete();
  
     return response()->json([
             "status" => 200,
             "message" => "Task deleted successfully.",
            "data" => $task
        ],200); 
       }else{
        return response()->json([
            "status"=> 404,
            "message"=> 'Task not found'
        ],404);
        }
    }

//     // edit a task
public function edit($id)
    {
        $user = auth('sanctum')->user();
    if (!$user) {
        return response()->json([
            'status' => 401,
            'message' => "Unauthorized"
        ], 401);
    }
      $task= Task::find($id);
    if($task){
        return response()->json([
           'status'=> 200,
            'task'=> $task
        ],200);
    }else {
       return response()->json([
           'status'=> 404,
           'message'=> 'No such task found!'
      ],404);
      }  
    }

//     // to update any task field 
 public function update(Request $request, int $id)
    {
          $user = auth('sanctum')->user();
    if (!$user) {
        return response()->json([
            'status' => 401,
            'message' => "Unauthorized"
        ], 401);
    }
        $validator = Validator::make($request->all(),[
        'title'=> 'required',
       'description'=> 'required',
       'status'=> 'required'
    ]);
    if($validator->fails()){
       return response()->json([
           'status'=> 422,
           'errors'=> $validator->messages()
       ],422);
   }else{
       $task = Task::find($id);
        
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
      ],200);
  }else {
      return response()->json([
           'status'=> 404,
            'message'=> 'No such task found!'
      ],500);
       }
    }
}

 