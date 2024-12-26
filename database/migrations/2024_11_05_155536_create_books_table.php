<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bj_books', function (Blueprint $table) {
            $table->integer('books_id', true);
            $table->string('books_category_code', 150)->nullable();
            $table->string('books_uuid_code', 150)->nullable();
            $table->string('books_title', 200)->nullable();
            $table->string('books_slug', 150)->nullable();
            $table->text('books_description')->nullable();
            $table->text('books_tags')->nullable();
            $table->string('books_price', 200)->nullable();
            $table->string('books_quantity', 200)->nullable();
            $table->string('books_status_cd', 50)->nullable();
            $table->dateTime('created_books_user_date')->nullable();
            $table->string('created_books_user_uuid', 150)->nullable();
            $table->string('created_books_user_username', 150)->nullable();
            $table->dateTime('updated_books_user_date')->nullable();
            $table->string('updated_books_user_uuid', 150)->nullable();
            $table->string('updated_books_user_username', 150)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bj_books');
    }
}
