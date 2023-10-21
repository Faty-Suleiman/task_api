<?php

namespace App\Http\Controllers;
use App\Models\Pagination; 
use Illuminate\Http\Request;

class PaginationController extends Controller
{
    

//public function index()
// {
//     $perPage = request()->input('per_page', 10); // Number of items per page, default to 10
//     $tasks = Task::paginate($perPage);

//     return response()->json($tasks);
//}


public function paginate()
    {
        $perPage = request()->input('per_page', 10); 
        $task = _Task::paginate($perPage);
    if($task){
        return response()->json([
            'status'=> 200,
            'pages' => $task
        ],200);
    }else {
        return response()->json([
                'status'=> 404,
                'message'=> ' Pages not found!'
        ],404);
        }  
        
    }


}
        







