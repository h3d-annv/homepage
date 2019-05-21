<?php

use Illuminate\Database\Seeder;

class UsersTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'h3dadmin',
            'email' => 'h3dadmin@admin.com',
                'password' => bcrypt('WRW*3LVv?]dKF+xG')
        ]);
    }
}
