<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bj_sessions', function (Blueprint $table) {
            $table->integer('session_id', true);
            $table->text('session_token')->nullable();
            $table->string('user_uuid', 150)->nullable();
            $table->string('user_username', 150)->nullable();
            $table->dateTime('session_start_at')->nullable();
            $table->dateTime('session_expired_at')->nullable();
            $table->dateTime('session_created_at')->nullable();
            $table->dateTime('session_updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bj_sessions');
    }
}
