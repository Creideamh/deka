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
        Schema::create('medical_infos', function (Blueprint $table) {
            $table->id();
            $table->string('existing_policy');
            $table->string('existing_policy_number')->default('n/a');
            $table->string('life_insurance_status');
            $table->string('refusal_reasons');
            $table->string('medical_health_status');
            $table->foreignId('application_id')->constrained('applications')->restrictOnDelete();
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
        Schema::dropIfExists('medical_infos');
    }
};
