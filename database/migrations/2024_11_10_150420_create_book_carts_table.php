<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bj_books_carts', function (Blueprint $table) {
            $table->integer('books_carts_id', true);
            $table->string('user_uuid', 150)->nullable();
            $table->string('books_carts_code', 150)->nullable();
            $table->string('books_uuid_code', 150)->nullable();
            $table->string('books_carts_quantity', 200)->nullable();
            $table->string('books_carts_price', 200)->nullable();
            $table->text('books_carts_description')->nullable();
            $table->string('books_carts_status_cd', 30)->nullable();
            $table->dateTime('created_books_carts_date')->nullable();
            $table->string('created_books_carts_user_uuid', 150)->nullable();
            $table->string('created_books_carts_user_username', 150)->nullable();
            $table->dateTime('updated_books_carts_date')->nullable();
            $table->string('updated_books_carts_user_uuid', 150)->nullable();
            $table->string('updated_books_carts_user_username', 150)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bj_books_carts');
    }
}
