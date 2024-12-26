<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bj_books_payment', function (Blueprint $table) {
            $table->integer('books_payment_id', true);
            $table->string('user_uuid', 150)->nullable();
            $table->string('books_invoice_code', 150)->nullable();
            $table->string('books_payment_code', 150)->nullable();
            $table->string('books_payment_price', 150)->nullable();
            $table->string('books_payment_quantity', 150)->nullable();
            $table->text('books_payment_description')->nullable();
            $table->string('books_payment_status_cd', 30)->nullable();
            $table->dateTime('books_payment_created_date')->nullable();
            $table->string('books_payment_created_user_uuid', 150)->nullable();
            $table->string('books_payment_created_user_username', 150)->nullable();
            $table->dateTime('books_payment_updated_date')->nullable();
            $table->string('books_payment_updated_user_uuid', 150)->nullable();
            $table->string('books_payment_updated_user_username', 150)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bj_books_payment');
    }
}
