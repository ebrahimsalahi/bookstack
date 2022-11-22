<?php

use Illuminate\Database\Seeder;
use App\Shelf;
class ShelfSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for($i=0;$i < 50;$i++){
            factory(Shelf::class)->create();
        }

    }
}
