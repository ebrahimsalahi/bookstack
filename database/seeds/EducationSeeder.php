<?php

use Illuminate\Database\Seeder;

class EducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('educations')->insert(array(
            array(
                'id' => 1,
                'name' => "نامشخص",
                'created_at'   => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at'   => \Carbon\Carbon::now()->toDateTimeString()
            ),
            array(
                'id' => 2,
                'name' => "زیر دیپلم",
                'created_at'   => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at'   => \Carbon\Carbon::now()->toDateTimeString()
            ),
            array(
                'id' => 3,
                'name' => "دیپلم",
                'created_at'   => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at'   => \Carbon\Carbon::now()->toDateTimeString()
            ),
            array(
                'id' => 4,
                'name' => "فوق دیپلم",
                'created_at'   => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at'   => \Carbon\Carbon::now()->toDateTimeString()
            ),
           array(
               'id' => 5,
               'name' => "لیسانس",
               'created_at'   => \Carbon\Carbon::now()->toDateTimeString(),
               'updated_at'   => \Carbon\Carbon::now()->toDateTimeString()
           ),
           array(
               'id' => 6,
               'name' => " فوق  لیسانس",
               'created_at'   => \Carbon\Carbon::now()->toDateTimeString(),
               'updated_at'   => \Carbon\Carbon::now()->toDateTimeString()
           ),
           array(
               'id' => 7,
               'name' => " دکتری",
               'created_at'   => \Carbon\Carbon::now()->toDateTimeString(),
               'updated_at'   => \Carbon\Carbon::now()->toDateTimeString()
           ),
            array(
                'id' => 8,
                'name' => " دکتری",
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
            ),







        ));
    }
}
