<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description')->nullable();
            $table->unsignedBigInteger('file_id');
            $table->unsignedBigInteger('school_class_id')->nullable();
            $table->string('type')->nullable();
            $table->ENUM('state', [
                'Ativo',
                'Inativo',
                'Cancelado'
            ])->default('Ativo');
            $table->timestamps();

            $table->foreign('file_id')->references('id')->on('files');
            $table->foreign('school_class_id')->references('id')->on('school_classes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents');
    }
}
