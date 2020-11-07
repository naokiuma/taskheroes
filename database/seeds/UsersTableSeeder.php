<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'email' => 'seeder@gmail.com',
            'password' => bcrypt('secret'),
            'name' => 'seeder1',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);
    }
}
