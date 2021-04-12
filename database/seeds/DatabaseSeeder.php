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
        // $this->call(UsersTableSeeder::class);
        \Illuminate\Support\Facades\DB::table('organizers')->where('email', 'demo1@worldskills.org')->update(['password_hash' => bcrypt('demopass1')]);
        \Illuminate\Support\Facades\DB::table('organizers')->where('email', 'demo2@worldskills.org')->update(['password_hash' => bcrypt('demopass2')]);

    }
}
