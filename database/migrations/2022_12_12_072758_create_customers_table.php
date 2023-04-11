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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('surname')->unique();
            $table->string('firstname')->unique();
            $table->string('gender');
            $table->date('birthdate');
            $table->string('birthplace');
            $table->string('nationality');
            $table->string('email');
            $table->string('phone_number');
            $table->text('home_address');
            $table->text('postal_address');
            $table->string('tin_number')->uniqid;
            $table->string('marital_status');
            $table->string('occupation');
            $table->string('form_of_identification');
            $table->string('id_number')->unique();
            $table->string('upload_document');
            $table->string('customer_signature');
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
        Schema::dropIfExists('customers');
    }
};
