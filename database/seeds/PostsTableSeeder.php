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
        

        \DB::table('posts')->delete();
        
        \DB::table('posts')->insert(array (
            0 => 
            array (
                'id' => '2',
                'text' => '123123',
                'user_id' => '2',
                'created_at' => '2017-10-12 15:03:38',
                'updated_at' => '2017-10-18 02:24:12',
            ),
            1 => 
            array (
                'id' => '3',
                'text' => 'Teste 3',
                'user_id' => '2',
                'created_at' => '2017-10-11 15:03:43',
                'updated_at' => '2017-10-12 15:03:43',
            ),
            2 => 
            array (
                'id' => '4',
                'text' => 'X9XZhkbopxL93pBIUaBU5A8vYiGDGFcw8422e6t019xBbK6P7v70B4N3rreQWhTCHVE9YVb0HDSTXNjvK7xfRbciJhZZqVpP61pfmec5Dt1Myt9Vvy1SByYnJICAS3Ut4uVlqXYgbxqL',
                'user_id' => '3',
                'created_at' => '2017-10-08 19:38:43',
                'updated_at' => '2017-10-08 19:38:43',
            ),
            3 => 
            array (
                'id' => '5',
                'text' => 'VRtXmvq0GVUvpetcPiVoQmwdwZgdsKXb4FtnzDkAhviOG2ekEEvvfLTUzGLiPa4HNVVEflQ3TBSdgLYdVHOUbwU6plFB0ikwy9vzDDeCYgJsDM1oYeM4Le5sCQVwHvApaV0ZcRLhF1Vv',
                'user_id' => '1',
                'created_at' => '2017-10-08 19:38:43',
                'updated_at' => '2017-10-08 19:38:43',
            ),
            4 => 
            array (
                'id' => '6',
                'text' => '48DjEciLprxkZZMiqoVvJ5w6jJfKRe5TrDC0gNer5iZotjssxQ0Fvix2oBGlskbX1KbGos6837vC99kB6TZsQlfPNLHW9CZVD5XDXxFiryC3fxqsQZy0epxEIACJmoDkt09UAcgqgJOR',
                'user_id' => '1',
                'created_at' => '2017-10-06 19:38:43',
                'updated_at' => '2017-10-06 19:38:43',
            ),
            5 => 
            array (
                'id' => '7',
                'text' => 'PNLB4hi0cOJast6FVwudIULC4nbTNygRx4mdyCS0weeIS436dKsol5qNRc9Ynef94x6UcgZraJQBSnxLJB5zhQMLqLgm9dXeATrZshSfsCECXusakJrDxhHJnar7qxLFC29T8WZ8sMAr',
                'user_id' => '2',
                'created_at' => '2017-10-08 19:38:43',
                'updated_at' => '2017-10-08 19:38:43',
            ),
            6 => 
            array (
                'id' => '8',
                'text' => 'NU54DYKsMjJ0w3CV4btVryR4MgoMsUTnJ3EjWQy5jnJ6Ge7i3QpatW4TvPHkGNajcvlHe1IblVIlpRCRZqH2fwdcMjcDMKLZzlps8ux6rWxRrfDn7VPI3NbbI7zTv1zjWB7EcjIXQWZW',
                'user_id' => '3',
                'created_at' => '2017-10-06 19:38:43',
                'updated_at' => '2017-10-06 19:38:43',
            ),
            7 => 
            array (
                'id' => '9',
                'text' => '0mVAJmHnjGmrWNLxZEfG4hisMN5SJ6WS1ZgudeKDR6NQaz2ZVHtrRRMS3VkMi2WWr1MasGg3l7lfOvi1zW2SrNLvD8iYTTBlBTABpt240srrANRWisucTDdtNU9qyappcAeIavdthRtQ',
                'user_id' => '3',
                'created_at' => '2017-10-10 19:38:43',
                'updated_at' => '2017-10-10 19:38:43',
            ),
            8 => 
            array (
                'id' => '11',
                'text' => 'V78wNe8hLXr96n35oDuLyeepfhPWFqvViKtpjsYthuhXqp6GHAcHRH7899uQR53oxLsDgDXEhojpsIuu8QpymUqwwafmmnItoUUoNhZic1Fd2QuwjR9d6mnLzZBMHQMXMm08xzKW95is',
                'user_id' => '2',
                'created_at' => '2017-10-10 19:38:43',
                'updated_at' => '2017-10-10 19:38:43',
            ),
            9 => 
            array (
                'id' => '12',
                'text' => 'Fw5DpI14wgcozoM13wpHumFEcXqzuLyprxuiyTdxAzkK6nA1QUCfYWa2UrZRGa97ciyCY7XgvnbAzaOWjra5VHYno1rB0MCELJ681rkNWNcYI7BnjiitNi5f94S02UVhwBeDdaPZfIlG',
                'user_id' => '2',
                'created_at' => '2017-10-11 19:38:43',
                'updated_at' => '2017-10-11 19:38:43',
            ),
            10 => 
            array (
                'id' => '13',
                'text' => 'JsXUxFUnc1sLBGk2WJKU8JR2MGOXkyYBIwgWpkqaDP5pENzHNTXcIp7yQmFggppMeFsYVqQHKErnwekxPo1VBDs6M7rCO2UCOGwl0E8Ed445ZyNlW59ZO6JLHfnW1CpfX9CMUHdYz7YI',
                'user_id' => '1',
                'created_at' => '2017-10-11 19:38:43',
                'updated_at' => '2017-10-11 19:38:43',
            ),
            11 => 
            array (
                'id' => '14',
                'text' => 'fRh9QbA6sjsOBIeOOnTEBJw2hB03crjPsfOBrUFJ54OFT2aMeJyInZA41Qv5Zd9N9gah3jceiKbbTGHxEtrgUZBlg7K9XIYImDeixVr6J4BeDiDCuN8FSLYMZve4FarhA9KrnQlpQMmU',
                'user_id' => '3',
                'created_at' => '2017-10-08 19:38:43',
                'updated_at' => '2017-10-08 19:38:43',
            ),
            12 => 
            array (
                'id' => '15',
                'text' => '123123',
                'user_id' => '1',
                'created_at' => '2017-10-10 19:38:43',
                'updated_at' => '2017-10-18 01:19:41',
            ),
            13 => 
            array (
                'id' => '16',
                'text' => 'VS3SuQRQbdwMFfSXnKgrXK6WAdTCbJcFVVz67hT9mzVSPN6zNIS7wp5hxV0cEtjuxsBFQoa5QTsuwGigGTu7KICZJVjHJ2HaCjW9L0HsAG8cZD9Anr6c0vQbVgMTMIJNQOtmEogPCIoI',
                'user_id' => '3',
                'created_at' => '2017-10-09 19:38:43',
                'updated_at' => '2017-10-09 19:38:43',
            ),
            14 => 
            array (
                'id' => '17',
                'text' => 'YHCix9OvYGHqjDbedhuX8GBYiuKNQyw2YDH2ofTbSioIVLBs75OrCxu0dSC8vV5MJdWEqbA6SaJ6zpd9Zc7CYGFcJvWqp9ED8fdTP7GKUVW6xhRhGiRiS7M9IyXioVJMlOEniLSfXzas',
                'user_id' => '2',
                'created_at' => '2017-10-08 19:38:43',
                'updated_at' => '2017-10-08 19:38:43',
            ),
            15 => 
            array (
                'id' => '18',
                'text' => 'HnRiMy8OLv9qXirikdiP76WPfGjc3hvyba9YAXGXk2vEec685nYHtz6q9AMyd8XWurI5g9Fk4vkYkoi7TRICMi1w6i3HSqWhlHCC9UeSjqUoMGPk4VqbiB1ooNHiO16XyR6pVSPQwgMT',
                'user_id' => '1',
                'created_at' => '2017-10-11 19:38:43',
                'updated_at' => '2017-10-11 19:38:43',
            ),
            16 => 
            array (
                'id' => '19',
                'text' => 'yJCKc26vUFYVWI31UMUgattI5adbgER2LJ7nvHM9LPqiJNGNLTgyTyCOZiKuxJerJYxCGRF5v5QFDID0WbodPvXveOMSkGMkAAFPwfi2p83Mi8j1ekrrEwM8QxwNckLh1nV9B6JoDARl',
                'user_id' => '3',
                'created_at' => '2017-10-11 19:38:43',
                'updated_at' => '2017-10-11 19:38:43',
            ),
            17 => 
            array (
                'id' => '20',
                'text' => '7M5nEBec91Cy9mrmomwcUNnj6cx9aGN2DcO22sZeZVYyvuhMskeBiL9oxHp0dMIdLIPyqQVi2Iv7z1JZhGmav2qvbbqUkaXGRrifXeqlceVjJmL3cjfJCvjYW3AcbEowoXMU75JHqPEH',
                'user_id' => '2',
                'created_at' => '2017-10-10 19:38:43',
                'updated_at' => '2017-10-10 19:38:43',
            ),
            18 => 
            array (
                'id' => '21',
                'text' => 'V7yFHiZtVTBKp5qeOCc1uhZTKCCm2OOoOihsSzdvIn3flS7xXllqa1XGtnEE3EnknInnWslGTlSFOPw4BPyEVc0Pa9iibmdxybdLQddGcQ1JVa9ymTCIAm50YpAevBWvTXRtYIhvNnTe',
                'user_id' => '2',
                'created_at' => '2017-10-08 19:38:43',
                'updated_at' => '2017-10-08 19:38:43',
            ),
            19 => 
            array (
                'id' => '33',
                'text' => '1234',
                'user_id' => '1',
                'created_at' => '2017-10-18 00:17:14',
                'updated_at' => '2017-10-18 00:17:14',
            ),
            20 => 
            array (
                'id' => '34',
                'text' => '1234',
                'user_id' => '1',
                'created_at' => '2017-10-18 00:17:22',
                'updated_at' => '2017-10-18 00:17:22',
            ),
        ));
        
        
    }
}