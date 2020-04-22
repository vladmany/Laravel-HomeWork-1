<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->string('annotation','2000');
            $table->string('author');
            $table->string('year');
            $table->string('genre_name')->default('Без жанра');
            $table->unsignedBigInteger('publisher_id')->nullable();
            $table->string('preview_path');
            $table->string('body_path');
            $table->timestamps();
        });

        Schema::table('books', function (Blueprint $table) {
            $table->foreign('genre_name')
                ->references('name')
                ->on('genres');

            $table->foreign('publisher_id')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
