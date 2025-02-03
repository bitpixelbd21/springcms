<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    public function up()
    {

        Schema::create('river_comments', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->nullable();
            $table->string('email')->nullable();
            $table->text('content')->nullable();
            // $table->foreignId('customer_id')->onDelete('cascade');
            $table->integer('blog_id')->onDelete('cascade')->nullable();
            $table->enum('status', ['pending', 'approve', 'trashed'])->default('pending');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
           // Default to 0 or 1, instead of 'pending'
        });

    }

    public function down()
    {
        Schema::dropIfExists('river_comments');
    }
}
