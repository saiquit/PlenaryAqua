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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_id');
            $table->boolean('active')->nullable()->default(false);
            $table->string('district')->nullable();
            $table->string('upazila')->nullable();
            $table->text('location')->nullable();
            $table->enum('type', ['home', 'work', 'other'])->nullable()->default('home');
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
        Schema::dropIfExists('addresses');
    }
};
