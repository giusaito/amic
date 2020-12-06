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
        $this->call(SettingSeeder::class);
        factory(App\Http\Models\SiteUtil::class, 10)->create();
        $this->call(ThemeSeeder::class);
        factory(App\Http\Models\Article::class, 10)->create();
        factory(App\Http\Models\Service::class, 20)->create();
        $this->call(ProjectSeeder::class);
        $this->call(ProjectEditionSeeder::class);
        $this->call(ProjectEditionSeeder::class);
    }
}
