<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i=0; $i <500 ; $i++) { 
            DB::table('authors')->insert([
                'name' => $faker->name,
                'email' => $faker->email,
                'github' => $faker->word,
                'twitter' => '@'.$faker->word,
                'location' => $faker->address,
                'latest_article_published' => $faker->sentence(6,true),
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')
            ]);
        }
    }
}
