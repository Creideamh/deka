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
        Schema::create('premium_payments', function (Blueprint $table) {
            $table->id();
            $table->decimal('premium_risk', 6);
            $table->decimal('premium_savings', 6);
            $table->decimal('premium_fee', 6);
            $table->decimal('premium_total', 6);
            $table->string('premium_frequency');
            $table->string('premium_mode');
            $table->date('premium_deduction');
            $table->char('premium_increase', 3);
            $table->foreignId('premium_payer_id')->constrained('premium_payers')->restrictOnDelete();
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
        Schema::dropIfExists('premium_payments');
    }
};
