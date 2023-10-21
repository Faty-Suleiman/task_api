<?php

namespace Database\Seeders;
 use App\Models\_Task;
 use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

       _Task::factory();
           $array = [20];
           $count = count($array);
            
        
        
    // \App\Models\User::create([
    //     'name'=>'Ahmad Abubakar',
    //     'email'=> 'ahm@gmail.com',
    //     'password'=> Hash::make('secret')
    //    ]); 
}
}