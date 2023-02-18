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

        DB::table('organizers')->update(['password_hash' => bcrypt('demopass')]);
        DB::table('attendees')->update(['password' => md5('password')]);
        $maxSpeakers = 20;
        if (!\App\Speaker::query()->count()) {
            factory(\App\Speaker::class, $maxSpeakers)->create();
        }
        $organizers = \App\Organizer::query()->get();
        foreach ($organizers as $organizer) {
            $events = $organizer->events;
            $speakersIds = $organizer->speakers->pluck('id')->toArray();
            foreach ($events as $event) {
                $rooms = $event->rooms;
                foreach ($rooms as $room) {
                    $sessions = $room->sessions;
                    foreach ($sessions as $session){
                        $dataUpdate = [
                            'speaker_id' => $speakersIds[rand(0, count($speakersIds) - 1)],
                        ];
                        $session->sessionSpeakers()->create($dataUpdate);
                    }
                }
            }
        }
    }
}
