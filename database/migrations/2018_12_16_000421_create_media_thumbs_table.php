<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaThumbsTable extends Migration
{
    protected $tableName = 'media_thumbs';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->increments('id');
            $table->string('path');
            $table->json('meta')->nullable();
            $table->string('mime_type')->nullable();

            $table->unsignedInteger('media_id')->nullable();
            $table
                ->foreign('media_id')
                ->references('id')
                ->on('media')
                ->onDelete('cascade');

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
        Schema::dropIfExists($this->tableName);
    }
}
