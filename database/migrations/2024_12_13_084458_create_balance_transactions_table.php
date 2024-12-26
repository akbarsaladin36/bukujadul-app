<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBalanceTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bj_balance_transactions', function (Blueprint $table) {
            $table->integer('balance_transaction_id', true);
            $table->string('balance_transaction_uuid', 200)->nullable();
            $table->string('balance_transaction_sender_id', 150)->nullable();
            $table->string('balance_transaction_receiver_id', 150)->nullable();
            $table->string('balance_transaction_amount', 150)->nullable();
            $table->string('balance_transaction_history_in_amount', 150)->nullable();
            $table->string('balance_transaction_history_out_amount', 150)->nullable();
            $table->text('balance_transaction_description')->nullable();
            $table->string('balance_transaction_process_cd', 30)->nullable();
            $table->string('balance_transaction_status_cd', 30)->nullable();
            $table->dateTime('balance_transaction_created_date')->nullable();
            $table->string('balance_transaction_created_user_uuid', 150)->nullable();
            $table->string('balance_transaction_created_user_username', 150)->nullable();
            $table->dateTime('balance_transaction_updated_date')->nullable();
            $table->string('balance_transaction_updated_user_uuid', 150)->nullable();
            $table->string('balance_transaction_updated_user_username', 150)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bj_balance_transactions');
    }
}
