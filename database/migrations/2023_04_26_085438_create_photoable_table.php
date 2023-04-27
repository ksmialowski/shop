<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhotoableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photoable', function (Blueprint $table) {
            $table->id('id_photoable');
            $table->unsignedBigInteger('photo_id');
            $table->unsignedBigInteger('photoable_id');
            $table->string('photoable_type');
            $table->timestamps();

            $table->foreign('photo_id')->references('id')->on('photos')->onDelete('cascade');
            $table->index('photo_id');
            $table->index('photoable_id');
            $table->index('photoable_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('photoable');
    }
}
