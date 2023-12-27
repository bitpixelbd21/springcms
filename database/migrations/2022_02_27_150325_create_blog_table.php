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
        Schema::create('river_blog', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('content')->unique();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('author_id')->nullable();
            $table->string('image')->nullable();
            $table->boolean('is_published')->default(0)->nullable();
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
        Schema::dropIfExists('river_blog');
    }
};
