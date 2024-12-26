<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bj_books_category', function (Blueprint $table) {
            $table->integer('book_category_id',true);
            $table->string('book_category_code', 150)->nullable();
            $table->string('book_category_name', 150)->nullable();
            $table->text('book_category_description')->nullable();
            $table->text('book_category_tags')->nullable();
            $table->string('book_category_status_cd', 30)->nullable();
            $table->dateTime('created_book_category_date')->nullable();
            $table->string('created_book_category_user_uuid', 150)->nullable();
            $table->string('created_book_category_user_username', 150)->nullable();
            $table->dateTime('updated_book_category_date')->nullable();
            $table->string('updated_book_category_user_uuid', 150)->nullable();
            $table->string('updated_book_category_user_username', 150)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bj_books_category');
    }
}
