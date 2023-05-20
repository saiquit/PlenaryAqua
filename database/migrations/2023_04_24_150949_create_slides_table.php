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
        Schema::create('slides', function (Blueprint $table) {
            $table->id();
            $table->string('category_id')->nullable();
            $table->string('heading_en')->nullable();
            $table->string('heading_bn')->nullable();
            $table->string('sub_heading_en')->nullable();
            $table->string('sub_heading_bn')->nullable();
            $table->string('image')->nullable()->default('default.jpg');
            $table->string('url')->nullable();
            $table->boolean('active')->nullable()->default(false);
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
        Schema::dropIfExists('slides');
    }
};
