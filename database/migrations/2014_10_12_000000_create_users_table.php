<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bj_users', function (Blueprint $table) {
            $table->integer('user_id',true);
            $table->string('user_uuid', 150)->nullable();
            $table->string('user_username', 150)->nullable();
            $table->string('user_email', 150)->nullable()->unique();
            $table->string('user_password', 200)->nullable();
            $table->string('user_first_name', 100)->nullable();
            $table->string('user_last_name', 100)->nullable();
            $table->text('user_address')->nullable();
            $table->string('user_phone_number', 50)->nullable();
            $table->string('user_role', 30)->nullable();
            $table->string('user_status_cd', 30)->nullable();
            $table->dateTime('created_user_date')->nullable();
            $table->string('created_user_uuid', 150)->nullable();
            $table->string('created_user_username', 150)->nullable();
            $table->dateTime('updated_user_date')->nullable();
            $table->string('updated_user_uuid', 150)->nullable();
            $table->string('updated_user_username', 150)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bj_users');
    }
}
