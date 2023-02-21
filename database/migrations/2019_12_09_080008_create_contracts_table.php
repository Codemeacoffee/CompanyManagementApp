<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('entity', 250);
            $table->string('teacher_nif', 250);
            $table->string('type', 250);
            $table->string('course_type', 250);
            $table->float('gross_salary');
            $table->float('retentions');
            $table->float('net_salary');
            $table->string('formative_planning', 250);
            $table->string('case_file', 250);
            $table->string('annuity', 250);
            $table->string('agreement', 250);
            $table->string('other_agreements', 250)->nullable();
            $table->string('sector', 250);
            $table->string('course', 250);
            $table->string('init_date',250);
            $table->string('end_date',250);
            $table->integer('total_hours')->nullable();
            $table->integer('daily_hours')->nullable();
            $table->string('schedule', 250)->nullable();
            $table->boolean('monday')->default(0);
            $table->boolean('tuesday')->default(0);
            $table->boolean('wednesday')->default(0);
            $table->boolean('thursday')->default(0);
            $table->boolean('friday')->default(0);
            $table->boolean('saturday')->default(0);
            $table->boolean('sunday')->default(0);
            $table->string('location', 250)->nullable();
            $table->text('observations')->nullable();
            $table->string('communication_date',250)->nullable();
            $table->string('processing_date', 250)->nullable();
            $table->integer('company_code')->nullable();
            $table->integer('employee_code')->nullable();
            $table->string('INEM_code', 250)->nullable();
            $table->boolean('processed')->default(0);
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
        Schema::dropIfExists('contracts');
    }
}
