<?php

namespace App\Http\Controllers;
use App\Models\Pagination; 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaginationController extends Controller
{
    
public function index()
{
    $perPage = request()->input('per_page', 5);
    $tasks = pagination::paginate($perPage); 

    if ($tasks->count() > 0) {
        return response()->json([
            'status' => 200,
            'tasks' => $tasks,
        ], 200);
    } else {
        return response()->json([
            'status' => 404,
            'message' => 'No tasks found!',
        ], 404);
    }
}
};
