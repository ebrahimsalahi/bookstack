<?php

use Illuminate\Database\Seeder;
use App\Book;
class BookSeeder extends Seeder
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
            factory(Book::class)->create();
        }
    }
}
