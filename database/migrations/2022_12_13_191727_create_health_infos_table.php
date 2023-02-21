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
        Schema::create('health_infos', function (Blueprint $table) {
            $table->id();
            $table->string('surname', 25)->unique();
            $table->string('firstname', 20)->unique();
            $table->string('illness_injury', 25);
            $table->string('hospital', 60);
            $table->string('duration');
            $table->string('present_condition');
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
        Schema::dropIfExists('health_infos');
    }
};
