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
        Schema::create('river_admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->integer('is_developer')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('role_id')->nullable();
            $table->string('image')->nullable();
            $table->boolean('is_active')->nullable()->default(0);
            $table->text('bio')->nullable();  // Added bio field
            $table->string('facebook')->nullable();  // Added facebook link field
            $table->string('instagram')->nullable();  // Added instagram link field
            $table->string('linkedin')->nullable();  // Added linkedin link field
            $table->string('youtube')->nullable();  // Added youtube link field
            $table->string('twitter')->nullable();  // Added twitter link field
            $table->rememberToken();
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
        Schema::dropIfExists('river_admins');
    }
};
