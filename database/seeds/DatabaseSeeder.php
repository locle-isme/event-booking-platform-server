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
        $this->call(AdminSeeder::class);
        DB::table('attendees')->update(['password' => bcrypt('password')]);
        DB::table('organizers')->update(['password_hash' => bcrypt('demopass')]);
        $maxSpeakers = 20;
        if (!\App\Models\Speaker::query()->count()) {
            factory(\App\Models\Speaker::class, $maxSpeakers)->create();
        }
        $organizers = \App\Models\Organizer::query()->get();
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
