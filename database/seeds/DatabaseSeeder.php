<?php

use App\Session;
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
        DB::table('attendees')->update(['password' => md5('password1')]);
        $max_speakers = 3;
        factory(\App\Speaker::class, $max_speakers)->create();
        $sessions = Session::all();
        foreach ($sessions as $session) {
            DB::table('session_speakers')->insert(
                [
                    'session_id' => $session->id,
                    'speaker_id' => rand(1, $max_speakers)
                ]
            );
        }
    }
}
