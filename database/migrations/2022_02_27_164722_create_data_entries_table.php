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
        Schema::create('river_data_entries', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('data_type_id');
            $table->string('data_type_slug');

            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->text('content')->nullable();
            $table->string('image')->nullable();
            $table->integer('order')->default(1); // default field, this will be used to order when fetching
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
        Schema::dropIfExists('river_data_entries');
    }
};
