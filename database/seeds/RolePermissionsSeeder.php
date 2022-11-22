<?php

use App\PermitRole;
use Illuminate\Database\Seeder;

class RolePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $role_permissions = array(



            array('name' => 'users_view','display_name' => 'مشاهده کاربران'),
            array('name' => 'users_add','display_name' => 'ایجاد کاربر ها'),
            array('name' => 'users_edit','display_name' => 'ویرایش کاربر ها'),
            array('name' => 'users_delete','display_name' => 'حذف کاربر ها'),

            array('name' => 'shelves_view','display_name' => 'مشاهده قفسه ها' ),
            array('name' => 'shelves_add','display_name' => 'ایجاد قفسه' ),
            array('name' => 'shelves_edit','display_name' => 'ویرایش قفسه' ),
            array('name' => 'shelves_delete','display_name' => 'حذف قفسه ' ),



            array('name' => 'books_view','display_name' => 'مشاهده کتاب ها' ),
            array('name' => 'books_add','display_name' => 'ایجاد کتاب' ),
            array('name' => 'books_edit','display_name' => 'ویرایش کتاب' ),
            array('name' => 'books_delete','display_name' => 'حذف کتاب' ),

            array('name' => 'chapters_view','display_name' => 'مشاهده فصل ها' ),
            array('name' => 'chapters_add','display_name' => 'ایجاد فصل'),
            array('name' => 'chapters_edit','display_name' => 'ویرایش فصل' ),
            array('name' => 'chapters_delete','display_name' => 'حذف فصل' ),


            array('name' => 'pages_view','display_name' => 'مشاهده صفحات' ),
            array('name' => 'pages_add','display_name' => 'ایجاد صفحه' ),
            array('name' => 'pages_edit','display_name' => 'ویرایش صفحه' ),
            array('name' => 'pages_delete','display_name' => 'حذف صفحه' ),




            array('name' => 'roles_view','display_name' => 'مشاهده نقش ها' ),
            array('name' => 'roles_add','display_name' => 'ایجاد نقش' ),
            array('name' => 'roles_edit','display_name' => 'ویرایش نقش' ),
            array('name' => 'roles_delete','display_name' => 'حذف نقش' ),


            array('name' => 'audit_view','display_name' => ' مشاهده لاگ ها '),
            array('name' => 'settings','display_name' => '  تنظیمات سایت '),
            array('name' => 'comments','display_name' => '  مدیریت نظرات کاربران '),










        );

        foreach ($role_permissions as $item){

            $value = json_decode(json_encode($item));
            $name = $value->name;
            $display_name = $value->display_name;
            DB::table('role_permissions')->insert(array(
                'name' => $name,
                'display_name' => $display_name,
                'created_at'   => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at'   => \Carbon\Carbon::now()->toDateTimeString()
            ));

        }



    }

}
