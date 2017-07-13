<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('users')->insert([
           'member_code'    => 'GDL-' . str_random(8),
           'first_name'     => 'Administrator',
           'last_name'      => 'Agualu',
           'email'          => 'admin@agualu.com',
           'password'       => bcrypt('1234'),
           'phone'          => '+523312345678',
           'cellphone'      => '+5213312345678',
           'state_id'       => 14,
           'city_id'        => 1,
           'street'         => 'Calle Real',
           'outdoor_number' => 2680,
           'suburb'         => 'Colonia Real',
           'postal_code'    => '123456',
           'range_id'       => 1, // Still no.
           'preferential'   => false,
           'status'         => 'Vigente'
       ]);
    }
}
