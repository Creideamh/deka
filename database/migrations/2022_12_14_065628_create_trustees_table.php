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
        Schema::create('trustees', function (Blueprint $table) {
            $table->id();
            $table->string('surname', 25);
            $table->string('firstname', 20);
            $table->string('trustee_gender', 6);
            $table->date('trustee_birthdate');
            $table->string('trustee_relationship', 10);
            $table->text('trustee_address', 255);
            $table->string('trustee_contact', 15);
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
        Schema::dropIfExists('trustees');
    }
};
