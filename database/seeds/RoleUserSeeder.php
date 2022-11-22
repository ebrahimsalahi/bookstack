<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\User;


class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('role_user')->insert([
            'role_id' => 1,
            'user_id' => 1,
        ]);

        $users = DB::table('users')->where('id','<>',1)->get();

        foreach ($users as $user ) {

            DB::table('role_user')->insert([
                'role_id' =>  DB::table('roles')->inRandomOrder()->first()->id,
                'user_id' => $user->id,
            ]);

        }

    }


}
