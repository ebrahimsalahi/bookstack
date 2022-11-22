<?php

use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('settings')->insert([
            'id' => 1,
            'title' => 'عنوان اصلی',
            'logo' => 'logo.png',
            'created_at'   => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at'   => \Carbon\Carbon::now()->toDateTimeString(),
        ]);
    }


}
