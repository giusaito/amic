<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        factory(App\Http\Models\SiteUtil::class, 10)->create();
        factory(App\Http\Models\CategorySiteUtil::class, 59)->create();
        $this->call(ProjectSeeder::class);
        $this->call(ProjectEditionSeeder::class);
        $this->call(ProjectEditionSeeder::class);
    }
}
