<?php

use Illuminate\Database\Seeder;

class SpeakerSeeder extends Seeder
{
    public function run()
    {
        \App\Speaker::factory(20)->create();
    }
}
