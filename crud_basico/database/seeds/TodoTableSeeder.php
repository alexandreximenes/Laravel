<?php

use Illuminate\Database\Seeder;

class TodoTableSeeder extends Seeder
{
    public function run()
    {
        factory(App\Todo::class, 7)->create();
    }
}
