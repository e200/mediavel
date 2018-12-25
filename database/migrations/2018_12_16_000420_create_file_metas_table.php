<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileMetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_metas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('client_name');
            $table->string('file_path')->nullable();

            $table->unsignedInteger('owner_id')->nullable();
            $table->unsignedInteger('parent_id')->nullable();

            $table->unsignedInteger('mime_type_id');
            $table->foreign('mime_type_id')
                ->references('id')
                ->on('mime_types')
                ->onDelete('cascade')
                ->onUpdate('cascade');

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
        Schema::dropIfExists('file_metas');
    }
}
