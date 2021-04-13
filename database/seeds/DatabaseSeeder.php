<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
        DB::table('organizers')->where('email', 'demo1@worldskills.org')->update(['password_hash' => bcrypt('demopass1')]);
        DB::table('organizers')->where('email', 'demo2@worldskills.org')->update(['password_hash' => bcrypt('demopass2')]);
        DB::table('attendees')->update(['password' => md5('Abcdef1234')]);
        $sessions = \App\Session::all();
        foreach ($sessions as $session) {
            DB::table('session_speakers')->insert(
                [
                    'session_id' => $session->id,
                    'speaker_id' => 3
                ]
            );
        }
    }
}
