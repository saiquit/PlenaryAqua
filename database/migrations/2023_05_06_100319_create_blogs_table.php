<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('cover_img')->nullable()->default('default.img');
            $table->string('author_name')->nullable();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->longText('short_desc')->nullable();
            $table->longText('content')->nullable();
            $table->integer('views')->unsigned()->nullable()->default(0);
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
        Schema::dropIfExists('blogs');
    }
};
