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
        Schema::create('district_variation', function (Blueprint $table) {
            $table->id();
            $table->foreignId('district_id');
            $table->foreignId('variation_id');
            // $table->integer('stock')->unsigned()->nullable()->default(0);
            // $table->float('price')->nullable();
            // $table->float('discounted_from_price')->nullable();
            // $table->float('discount')->nullable();
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
        Schema::dropIfExists('district_variation');
    }
};
