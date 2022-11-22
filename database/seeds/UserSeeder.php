<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('users')->insert(array(
            array(
                'id' => 1,
                'name' => "ابراهیم صلاحی",
                'email' => "admin@admin.com",
                'mobile' => "09033680535",
                'image_id' => 1,
                'is_active' => 1,
                'province_id' => 1,
                'edu_id' => 1,
                'password' => bcrypt('74107410'),
                'created_at'   => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at'   => \Carbon\Carbon::now()->toDateTimeString()
            ),
           array(
               'id' => 2,
               'name' => "مهمان 1",
               'email' => "guest@guest.com",
               'mobile' => "09033680536",
               'image_id' => 1,
               'is_active' => 1,
               'province_id' => 1,
               'edu_id' => 1,
               'password' => bcrypt('74107410'),
               'created_at'   => \Carbon\Carbon::now()->toDateTimeString(),
               'updated_at'   => \Carbon\Carbon::now()->toDateTimeString()
           )
        ));

       /*
        * create fake users
        for($i=0;$i < 50;$i++){
            factory(User::class)->create();
        }

      */


    }
}
