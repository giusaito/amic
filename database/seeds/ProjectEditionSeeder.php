<?php

use Illuminate\Database\Seeder;
use App\Http\Models\ProjectEdition;

class ProjectEditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ProjectEdition::class, 50)->create();
    }
}
