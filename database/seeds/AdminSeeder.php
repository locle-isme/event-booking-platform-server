<?php

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataUpdate = [
            'username' => 'admin',
            'password' => bcrypt('123456'),
            'email' => 'locle.isme@gmail.com',
            'first_name' => 'Loc',
            'last_name' => 'Le',
        ];
        Admin::query()->updateOrCreate(['username' => 'admin'], $dataUpdate);
    }
}
