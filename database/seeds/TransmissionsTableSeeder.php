<?php

use Illuminate\Database\Seeder;

class TransmissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transmissions')->insert([
            [
                'name' => 'Автоматическая'
            ],
            [
                'name' => 'Механическая'
            ],
            [
                'name' => 'Роботизированная'
            ],
            [
                'name' => 'Вариатор'
            ],
        ]);
    }
}
