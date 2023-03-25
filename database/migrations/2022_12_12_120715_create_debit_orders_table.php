<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('debit_orders', function (Blueprint $table) {
            $table->id();
            $table->string('debit_order_surname', 25);
            $table->string('debit_order_firstname', 20);
            $table->string('bank_name');
            $table->string('bank_branch');
            $table->string('account_number', 11);
            $table->string('account_type', 10);
            $table->string('account_signature', 60);
            $table->foreignId('application_id')->constrained('applications')->restrictOnDelete();
            $table->foreignId('user_id')->constrained('users')->restrictOnDelete();
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
        Schema::dropIfExists('debit_orders');
    }
};
