<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFurnitureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('furniture', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code', 250);
            $table->string('location', 250);
            $table->text('description')->nullable();
            $table->integer('amount');
            $table->string('status', 250);
            $table->text('observations')->nullable();
            $table->text('originalPlacement')->nullable();
            $table->text('currentPlacement')->nullable();
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
        Schema::dropIfExists('furniture');
    }
}
