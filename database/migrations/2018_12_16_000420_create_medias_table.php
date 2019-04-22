<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('file_name')->nullable();
            $table->string('file_path');

            $table->unsignedInteger('owner_id')->nullable();
            $table->unsignedInteger('parent_id')->nullable();

            $table->string('mime_type');

            $table->unsignedInteger('file_collection_id')->nullable();
            $table->foreign('file_collection_id')
                ->references('id')
                ->on('file_collections')
                ->onDelete('cascade')
                ->onUpdate('cascade');

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
        Schema::dropIfExists('medias');
    }
}
