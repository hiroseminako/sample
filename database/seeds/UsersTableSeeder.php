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
        // 初期のユーザー情報
        DB::table('users')->insert([
            'username' => 'hirose',
            'mail' => 'hirose@gmail.com',
            'password' => 'hirose123'
        ]);
    }
}
