<?php

use Illuminate\Database\Seeder;
use App\BookComment;

class BookCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for($i=0;$i < 100;$i++){
            factory(BookComment::Class)->create();
        }
    }
}

