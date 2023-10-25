<?php

namespace Tests\Feature;

use Illuminate\Database\Eloquent\Factories\Factory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;

 

use App\Models\Task;
class TaskTest extends TestCase
{
    /**
     * @ test.
     */
    use RefreshDatabase;
    public function test_getAll_task()   // get all tasks
    {
        $task = Task::factory()->create();
    
        $tasks = Task::all();
        $response = $this->getJson('GET',['get-all-tasks{$task}']);

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => ['title', 'description', 'status', 'user_id']]);
        
    }

        public function test_create_task()  // to create a new task
        
    {
        $tasks = Task::factory(5)->create();
        $data = [
       'title' => 'New Task',
      'description' => 'A test task',
        'status' => 'pending',
        'user_id'=> 'user_id'
     ];

     $response = $this->json('POST','/create-task', $data);

     $response->assertStatus(201); 
     $response->assertJson(['message' => 'Task created successfully']);

    
    
     }

    public function test_read_task() // to get a single task
    {
        $user = auth('sanctum')->user();
         $task = factory(Task::class)->create();
        

        $response = $this->json('GET', ['/get-single-task/{id}' . $task->id]);

        $response->assertStatus(200); // 200 OK status code
        
        $response->assertJsonStructure(['data' => ['title', 'description', 'status', 'user_id']]);
    }

    public function test_update_task()  // to update a task
    {
        $task = factory(Task::class)->create();

        $updatedData = [
        'title' => 'Updated Title',
        'description' => 'Updated Description',
    ];
    $response = $this->json('PUT', ['/update-task/{id}' . $task->id, $updatedData]);

        $response->assertStatus(200); // 200 OK status code
        $response->assertJsonStructure(['message' => ['title', 'description', 'status', 'user_id']]);
    }

    public function test_edit_task() // to edit
    {
        $task = factory(Task::class)->create();

        $editeddData = [
        'title' => 'Edited Title',
        'description' => 'Edited Description',
    ];
    $response = $this->json('PATCH', ['/edit-task/{id}' . $task->id, $editeddData]);

        $response->assertStatus(200); // 200 OK status code
        $response->assertJsonStructure(['message' => ['title', 'description', 'status', 'user_id']]);
    }
    public function test_delete_task()  // to delete
    {
       $task = factory(Task::class)->create();

    $response = $this->json('DELETE', '/delete-task/{id}' . $task->id);

        $response->assertStatus(204); // 204 No Content status code
        $response->assertJson(['message' => ' Task successfully deleted']);
    }
}

       




