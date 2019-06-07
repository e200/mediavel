<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->index()->nullable();
            $table->string('relative_path');
            $table->integer('width')->nullable();
            $table->integer('height')->nullable();
            $table->string('mime_type')->nullable();
            $table->boolean('preserve_original')->default(true);

            $table->unsignedInteger('mediable_id')->nullable();
            $table->string('mediable_type')->nullable();

            $table->unsignedBigInteger('media_collection_id')->nullable();
            $table
                ->foreign('media_collection_id')
                ->references('id')
                ->on('media_collections');

            $table->unsignedBigInteger('user_id')->nullable();

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
        Schema::dropIfExists('media');
    }
}
