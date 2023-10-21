<?php

namespace Database\Seeders;
use App\Models\_Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *@ return void
     */
    
    public function run(): void
    {
        $this->call([
            TaskSeeder::class
        ]);
        // $faker = Faker::create();
        // foreach(range (1,10) as $index){
        //     DB::table('Task')->insert([
        //         'title'=>$faker->text(30),
        //         'description'=>$faker->text(300),
        //         // 'status'=>$faker->text->text(['pending, in_progress, completed'])
        //     ]);
            
        }
    }
    
    

