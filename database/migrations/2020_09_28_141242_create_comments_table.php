<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    public function up()
    {

        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->onDelete('cascade');
            $table->text('content');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->tinyInteger('is_active')->default(0);  // Default to 0 or 1, instead of 'pending'
        });

    }

    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
