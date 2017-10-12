<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Kevin Santos',
                'email' => 'keviinlouis@hotmail.com',
                'password' => '$2y$10$aFOjnymcKCyBxw4EoiJnx.h1ju2Sn/ADolxjXIKsTH.hwEKqteSJS',
                'remember_token' => 'lCzkAkRo9SLahEyercgsB8lOjaeqUrGldvDQ7gxkGxYG25afXoKsY67YYxHT',
                'created_at' => '2017-10-10 17:20:14',
                'updated_at' => '2017-10-10 17:20:14',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Wendell Neander',
                'email' => 'www@neander.com',
                'password' => '$2y$10$aFOjnymcKCyBxw4EoiJnx.h1ju2Sn/ADolxjXIKsTH.hwEKqteSJS',
                'remember_token' => NULL,
                'created_at' => '2017-10-10 17:20:14',
                'updated_at' => '2017-10-10 17:20:14',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Ronaldo Bianch',
                'email' => 'ronaldo@bianchi.com',
                'password' => '$2y$10$aFOjnymcKCyBxw4EoiJnx.h1ju2Sn/ADolxjXIKsTH.hwEKqteSJS',
                'remember_token' => NULL,
                'created_at' => '2017-10-10 17:20:14',
                'updated_at' => '2017-10-10 17:20:14',
            ),
        ));
        
        
    }
}