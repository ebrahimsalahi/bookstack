<?php

use Illuminate\Database\Seeder;
use App\Chapter;
class ChapterSeeder extends Seeder
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
            factory(Chapter::class)->create();
        }
    }
    
}
