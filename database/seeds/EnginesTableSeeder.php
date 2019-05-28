<?php

use Illuminate\Database\Seeder;

class EnginesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('engines')->insert([
            [
                'name' => 'Бензиновый'
            ],
            [
                'name' => 'Дизельный'
            ],
            [
                'name' => 'Гибридный'
            ]
        ]);
    }
}
