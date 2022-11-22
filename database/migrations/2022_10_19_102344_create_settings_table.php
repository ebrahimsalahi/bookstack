<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('logo');
            $table->text('rules')->nullable()->default('متن قوانین سایت');
            $table->text('about')->nullable()->default('ممتن درباره ما');
            $table->tinyInteger('register_status')->default('1');
            $table->string('phone')->nullable()->default('09033680535-09121412020');
            $table->string('email')->nullable()->default('ebrahimsalahi@gmail.com');
            $table->timestamps();
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_bin';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
