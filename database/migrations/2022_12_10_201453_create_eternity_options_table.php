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
        Schema::create('eternity_options', function (Blueprint $table) {
            $table->id();
            $table->decimal('Option', 10, 2)->unsigned();
            $table->integer('Age')->unsigned();
            $table->string('Relationship');
            $table->decimal('STP', 8, 2);
            $table->decimal('FDB', 8, 2);
            $table->decimal('ANR', 8, 2);
            $table->decimal('HSB', 8, 2);
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
        Schema::dropIfExists('eternity_options');
    }
};
