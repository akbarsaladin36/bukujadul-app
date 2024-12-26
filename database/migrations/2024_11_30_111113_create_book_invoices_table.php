<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bj_books_invoice', function (Blueprint $table) {
            $table->integer('books_invoice_id', true);
            $table->string('user_uuid', 150)->nullable();
            $table->string('books_carts_code', 150)->nullable();
            $table->string('books_invoice_code', 150)->nullable();
            $table->string('books_invoice_quantity', 200)->nullable();
            $table->string('books_invoice_price', 200)->nullable();
            $table->text('books_invoice_description')->nullable();
            $table->string('books_invoice_status_cd', 30)->nullable();
            $table->dateTime('books_invoice_created_date')->nullable();
            $table->string('books_invoice_created_user_uuid', 150)->nullable();
            $table->string('books_invoice_created_user_username', 150)->nullable();
            $table->dateTime('books_invoice_updated_date')->nullable();
            $table->string('books_invoice_updated_user_uuid', 150)->nullable();
            $table->string('books_invoice_updated_user_username', 150)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bj_books_invoice');
    }
}
