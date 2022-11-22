<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ImageSeeder::class);
        $this->call(ProvinceSeeder::class);
        $this->call(EducationSeeder::class);
        $this->call(RoleSeeder::class);

        $this->call(UserSeeder::class);
        $this->call(RoleUserSeeder::class);
        $this->call(PermissionRoleSeeder::class);
        $this->call(RolePermissionsSeeder::class);

        $this->call(SettingSeeder::class);

        $this->call(ShelfSeeder::class);
        $this->call(BookSeeder::class);
        $this->call(ChapterSeeder::class);
        $this->call(PageSeeder::class);
        $this->call(BookCommentSeeder::class);
        $this->call(PermissionRoleSeeder::class);




    }
}
