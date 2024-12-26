<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bj_users', function (Blueprint $table) {
            $table->string('user_balance_transaction_amount', 150)->after('user_phone_number')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bj_users', function (Blueprint $table) {
            $table->dropColumn('user_balance_transaction_amount');
        });
    }
}
