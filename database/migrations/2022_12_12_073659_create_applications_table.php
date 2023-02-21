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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('policy_number');
            $table->integer('status');
            $table->foreignId('user_id')->constrained('users')->restrictOnDelete();
            $table->decimal('proposed_sum', 10, 2);
            $table->decimal('monthly_risk_premium', 10, 2);
            $table->date('signature_date')->nullable();
            $table->foreignId('customer_id')->constrained('customers')->restrictOnDelete();
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
        Schema::dropIfExists('applications');
    }
};
