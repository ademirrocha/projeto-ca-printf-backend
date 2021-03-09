<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentTextsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_texts', function (Blueprint $table) {
            $table->id();
            $table->char('content');
            $table->text('text');
            $table->unsignedBigInteger('file_id')->nullable();
            $table->enum('type', [
                'text',
                'image'
            ])->default('text');
            $table->timestamps();
            
            $table->foreign('file_id')->references('id')->on('files');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('content_texts');
    }
}
