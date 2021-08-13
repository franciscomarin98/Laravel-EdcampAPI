<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumnos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name', 255);
            $table->string('last_name', 255);
            $table->string('email', 255)->unique();
            $table->enum('status', ['Paid', 'Pending'])->default('Pending');
            $table->boolean('is_ecuadorian');
            $table->boolean('assistance')->default(false);
            $table->string('phone', 15);
            $table->unsignedInteger('empresa_id');
            $table->foreign('empresa_id')
                ->references('id')
                ->on('empresas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alumnos');
    }
}
