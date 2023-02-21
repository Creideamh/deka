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
        Schema::create('premium_payers', function (Blueprint $table) {
            $table->id();
            $table->char('premium_title', 3);
            $table->string('premium_surname', 25);
            $table->string('premium_firstname', 20);
            $table->date('premium_birthdate');
            $table->string('premium_mobile_number', 15);
            $table->string('premium_email');
            $table->string('premium_tin_number');
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
        Schema::dropIfExists('premium_payers');
    }
};
