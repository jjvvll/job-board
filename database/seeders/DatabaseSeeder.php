<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Employer;
use App\Models\Job;// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        // User::factory(10)->create();

        User::factory(300)->create();

        $user = User::all()->shuffle();

        for ($i = 0; $i < 20; $i++){
            Employer::factory()->create([
                'user_id' => $user->pop()->id
            ]);
        }

        $employer = Employer::all();


        for($i = 0; $i < 100; $i++){
            Job::factory()->create([
                'employer_id' =>$employer->random()->id
            ]);
        }

        //\App\Models\Job::factory(100)->create();




    }
}
