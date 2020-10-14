<?php

use Illuminate\Database\Seeder;
use App\Http\Models\Project;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Project::class, 50)->create();
    }
}
