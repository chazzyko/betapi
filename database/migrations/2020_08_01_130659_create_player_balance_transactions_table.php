<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayerBalanceTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('balance_transactions', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('player_id')
                ->references('id')
                ->on('players')
                ->onDelete('cascade');
            $table->double('amount', 10,2);
            $table->double('amount_before', 10,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('balance_transactions');
    }
}
