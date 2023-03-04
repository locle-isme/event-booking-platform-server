<?php

use Illuminate\Database\Seeder;

class SpeakerSeeder extends Seeder
{
    public function run()
    {
        \App\Models\Speaker::factory(5)->create();
    }
}
