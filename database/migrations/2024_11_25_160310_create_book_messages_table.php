<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bj_messages', function (Blueprint $table) {
            $table->integer('messages_id', true);
            $table->string('sender_uuid', 150)->nullable();
            $table->string('receiver_uuid', 150)->nullable();
            $table->string('messages_code', 150)->nullable();
            $table->string('messages_title', 100)->nullable();
            $table->text('messages_description')->nullable();
            $table->string('messages_status_cd', 30)->nullable();
            $table->dateTime('messages_created_date')->nullable();
            $table->string('messages_created_user_uuid', 150)->nullable();
            $table->string('messages_created_user_username', 150)->nullable();
            $table->dateTime('messages_updated_date')->nullable();
            $table->string('messages_updated_user_uuid', 150)->nullable();
            $table->string('messages_updated_user_username', 150)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bj_messages');
    }
}
