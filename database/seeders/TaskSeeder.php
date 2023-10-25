<?php

namespace Database\Seeders;
 use App\Models\Task;
 use Illuminate\Database\Console\Seeds\WithoutModelEvents;
 use Illuminate\Database\Eloquent\Factories\Factory;
 use Illuminate\Database\Seeder;
 use Illuminate\Database\Seeders\DB;
 
//  use Illuminate \Support\Facades\Hash;



 class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * @ return void
     */
    public function run(): void
    
    {

       Task::factory();
           $array = [20];
           $count = count($array);
            
        
        
     
}
}