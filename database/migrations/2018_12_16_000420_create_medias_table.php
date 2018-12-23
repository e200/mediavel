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
            $table->string('client_name');
            $table->string('file_name');

            $table->unsignedInteger('owner_id')->nullable();
            $table->unsignedInteger('parent_id')->nullable();

            $table->unsignedInteger('mime_type_id');
            $table->foreign('mime_type_id')
                ->references('id')
                ->on('mime_types')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->unsignedInteger('thumbnail_size_id')->nullable();
            $table->foreign('thumbnail_size_id')
                ->references('id')
                ->on('thumbnail_sizes')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->unsignedInteger('media_collection_id')->nullable();
            $table->foreign('media_collection_id')
                ->references('id')
                ->on('media_collections')
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
