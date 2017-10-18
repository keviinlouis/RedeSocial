<?php

use Illuminate\Database\Seeder;

class PostLikesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('post_likes')->delete();
        
        \DB::table('post_likes')->insert(array (
            0 => 
            array (
                'post_id' => '2',
                'user_id' => '1',
                'created_at' => '2017-10-18 02:22:52',
                'updated_at' => '2017-10-18 02:22:52',
            ),
        ));
        
        
    }
}