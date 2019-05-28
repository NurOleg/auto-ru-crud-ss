<?php

use Illuminate\Database\Seeder;

class MarksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('marks')->insert([
            [
                'name' => 'Лада'
            ],
            [
                'name' => 'BMW'
            ],
            [
                'name' => 'Mini Cooper'
            ],
            [
                'name' => 'Volvo'
            ],
            [
                'name' => 'Mercedes'
            ],
            [
                'name' => 'Audi'
            ],
            [
                'name' => 'Kia'
            ],
            [
                'name' => 'Ford'
            ],
            [
                'name' => 'Chevrolet'
            ],
        ]);
    }
}
