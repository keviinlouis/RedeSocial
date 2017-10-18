<?php

use Illuminate\Database\Seeder;

class UserFollowsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('user_follows')->delete();
        
        \DB::table('user_follows')->insert(array (
            0 =>
            array (
                'followed_id' => '2',
                'following_id' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 =>
            array (
                'followed_id' => '3',
                'following_id' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}