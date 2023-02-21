<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExternalIncidencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('external_incidences', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('incidence', 250);
            $table->string('location', 250);
            $table->string('informant', 250);
            $table->string('contact', 250)->nullable();
            $table->string('responsible', 250)->nullable();
            $table->boolean('solved')->default(0);
            $table->text('solution')->nullable();
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
        Schema::dropIfExists('external_incidences');
    }
}
