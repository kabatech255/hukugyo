<?php

use Illuminate\Database\Seeder;

class JobsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          // Fakerを使う
          $faker = Faker\Factory::create('ja_JP');
          // ランダムにジョブズを19件作成
          $user_id = 2;
          for ($i = 0; $i < 18; $i++)
          {
              DB::table('jobs')->insert([
                  'user_id' => $user_id,
                  'title' => $faker->text(30),
                  'body' => $faker->text(191),
                  'price' => $faker->numberBetween(1000, 10000),
                  'image' => 'noimage.jpg',
                  'created_at' => $faker->dateTime(),
                  'updated_at' => $faker->dateTime()
              ]);
              $user_id++;
              if($user_id > 9){
                $user_id = 2;
              }
          }
    }
}
