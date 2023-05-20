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
        Schema::create('variations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id');
            $table->foreignId('district_id');
            $table->float('weight')->nullable();
            $table->float('gross_weight')->nullable();
            $table->string('name_en');
            $table->string('name_bn');
            $table->string('slug');
            $table->text('desc_en')->nullable();
            $table->text('desc_bn')->nullable();
            $table->integer('stock')->unsigned()->nullable()->default(0);
            $table->float('price')->nullable();
            $table->float('discounted_from_price')->nullable();
            $table->float('discount')->nullable();
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
        Schema::dropIfExists('variations');
    }
};
