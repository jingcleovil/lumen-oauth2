<?php

use Illuminate\Database\Seeder;

class OAuthUsersSeeder extends Seeder
{
    public function run()
    {
        DB::table('oauth_users')->insert(array(
            'username'   => "testuser",
            'password'   => sha1("testpassword"),
            'first_name' => "test",
            'last_name'  => "user",
        ));
    }
}