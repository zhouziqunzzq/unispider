<?php

use Illuminate\Database\Seeder;

class TwitterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $i = 100;
        while($i != 0) {
            DB::table('tweets')->insert([
                'origin_id' => str_random(10),
                'origin_created_at' => time() + random_int(-10240, 0),
                'text' => str_random(128),
                'jsondata' => json_encode(str_random(128))
            ]);
            $i = $i - 1;
        }
    }
}
