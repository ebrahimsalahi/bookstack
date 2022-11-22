<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('roles')->insert(array(

            array(
                'name' => "مدیر ارشد",
                'description' => 'توضیحات نقش مدیریت',
                'created_at'   => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at'   => \Carbon\Carbon::now()->toDateTimeString()
            ),
            array(
                'name' => "مهمان",
                'description' => 'توضیحات نقش مهمان',
                'created_at'   => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at'   => \Carbon\Carbon::now()->toDateTimeString()
            )


        ));
    }
}
