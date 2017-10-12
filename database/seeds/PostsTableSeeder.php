<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $data = array (
            0 =>
                array (
                    'id' => 1,
                    'text' => 'Teste 1',
                    'user_id' => 1,
                    'created_at' => '2017-10-12 15:03:33',
                    'updated_at' => '2017-10-12 15:03:33',
                ),
            1 =>
                array (
                    'id' => 2,
                    'text' => 'Teste 2',
                    'user_id' => 2,
                    'created_at' => '2017-10-12 15:03:38',
                    'updated_at' => '2017-10-12 15:03:38',
                ),
            2 =>
                array (
                    'id' => 3,
                    'text' => 'Teste 3',
                    'user_id' => 2,
                    'created_at' => '2017-10-11 15:03:43',
                    'updated_at' => '2017-10-12 15:03:43',
                )
        );
        $i = 4;
        while($i <= 30){
            $dateTime = \Carbon\Carbon::now()->subDay(rand(1, 7));
            $data[count($data)] = [
                'id' => $i,
                'text' => str_random(140),
                'user_id' => rand(1, 3),
                'created_at' => $dateTime->toDateTimeString(),
                'updated_at' => $dateTime->toDateTimeString(),
            ];
            $i++;
        }

        \DB::table('posts')->delete();
        
        \DB::table('posts')->insert($data);
        
        
    }
}