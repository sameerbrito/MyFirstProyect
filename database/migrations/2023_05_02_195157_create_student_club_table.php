<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentClubTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_club', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('students_id')
                    ->nullable();

            $table->foreign('students_id')
                    ->references('id')
                    ->on('students')
                    ->onDelete('set null');

            $table->unsignedBigInteger('club_id')
                    ->nullable();

            $table->foreign('club_id')
                    ->references('id')
                    ->on('clubs')
                    ->onDelete('set null');

            $table->date('inscription');
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
        Schema::dropIfExists('student_club');
    }
}
