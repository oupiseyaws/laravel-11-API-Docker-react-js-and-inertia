<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TasksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create 10 projects each project has 10 tasks
         Project::factory()->count(10)->create()->each(function ($project) {
            $project->tasks()->saveMany(\App\Models\Task::factory()->count(10)->make());
        });
    }
}
