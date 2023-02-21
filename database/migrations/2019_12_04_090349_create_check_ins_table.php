<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckInsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_ins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('receiver', 250)->nullable();
            $table->string('entry_code', 250)->nullable();
            $table->string('document')->nullable();
            $table->string('date', 10)->nullable();
            $table->string('destination')->nullable();
            $table->string('sender', 250)->nullable();
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
        Schema::dropIfExists('check_ins');
    }
}
