<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComputersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('computers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code', 250);
            $table->string('name', 250);
            $table->string('brand', 250)->nullable();
            $table->string('model', 250)->nullable();
            $table->string('serial', 250);
            $table->string('ip', 250);
            $table->string('processor', 250);
            $table->string('memory', 250);
            $table->string('hardDrive', 250);
            $table->string('operatingSystem', 250);
            $table->boolean('CD_ROM');
            $table->string('status', 250);
            $table->string('location', 250);
            $table->text('originalPlacement')->nullable();
            $table->text('currentPlacement')->nullable();
            $table->text('observations')->nullable();
            $table->boolean('deceased');
            $table->string('deceaseDate', 250)->nullable();
            $table->boolean('warranty');
            $table->string('warrantyEndDate', 250)->nullable();
            $table->string('provider', 250)->nullable();
            $table->string('gateway', 250)->nullable();
            $table->string('DNS1', 250)->nullable();
            $table->string('DNS2', 250)->nullable();
            $table->string('purchaseDate', 250);
            $table->string('activationKey', 250)->nullable();
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
        Schema::dropIfExists('computers');
    }
}
