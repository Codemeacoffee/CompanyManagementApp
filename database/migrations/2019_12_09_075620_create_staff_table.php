<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 250);
            $table->text('address');
            $table->string('city', 250);
            $table->string('postal_code');
            $table->text('nif');
            $table->text('social_security');
            $table->string('birth_date', 250);
            $table->text('phone');
            $table->text('bank');
            $table->text('CC');
            $table->string('marital_status', 250);
            $table->integer('children')->default(0);
            $table->string('email')->nullable();
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
        Schema::dropIfExists('staff');
    }
}
