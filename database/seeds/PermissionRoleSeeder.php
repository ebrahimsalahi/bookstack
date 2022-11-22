<?php

use Illuminate\Database\Seeder;
use App\PermitRole;
class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //


        $permissions = DB::table('role_permissions')->get()->all();
        foreach ($permissions as $permission) {
            $value = json_decode(json_encode($permission));
            $id = $value->id;

            DB::table('permission_role')->insert([
                'role_id' => 1,
                'permission_id' => $id,
            ]);


        }

        DB::table('permission_role')->insert([
            'role_id' => 2,
            'permission_id' => 27,
        ]);





    }
}
