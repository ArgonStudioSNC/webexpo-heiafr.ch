<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->enum('degree', ['bachelor', 'master']);
            $table->year('year');

            $table->foreignId('student_id');
            $table->foreignId('site_id')->nullable();
            $table->foreignId('professor_id')->nullable();
            $table->foreignId('workshop_id')->nullable();

            $table->json('experts')->nullable();
            $table->string('title');
            $table->string('lead')->nullable();
            $table->text('text')->nullable();
            $table->timestamps();

            $table->foreign('student_id')->references('id')->on('students')
            ->onDelete('cascade');
            $table->foreign('site_id')->references('id')->on('sites')
            ->onDelete('cascade');
            $table->foreign('professor_id')->references('id')->on('professors')
            ->onDelete('cascade');
            $table->foreign('workshop_id')->references('id')->on('workshops')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
