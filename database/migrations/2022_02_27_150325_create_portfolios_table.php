<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('river_portfolios', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('content');
            $table->text('short_desc')->nullable();
            $table->string('icon')->nullable();
            $table->string('image')->nullable();
            $table->string('client')->nullable();
            $table->string('category')->nullable();
            $table->string('project_name')->nullable();
            $table->text('overview')->nullable();
            $table->text('problem')->nullable();
            $table->text('challenges')->nullable();
            $table->text('solutions')->nullable();
            $table->integer('sort_order')->default(1)->nullable();
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
        Schema::dropIfExists('river_portfolios');
    }
};
