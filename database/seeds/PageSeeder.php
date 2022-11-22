<?php

use Illuminate\Database\Seeder;
use App\Page;
class PageSeeder extends Seeder
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
            factory(Page::class)->create();
        }
    }
}
