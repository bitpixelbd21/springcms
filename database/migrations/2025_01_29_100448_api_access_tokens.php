<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('api_access_tokens', function (Blueprint $table) {
            $table->id();
            $table->string('token')->unique();
            // $table->timestamp('created_at')->nullable();
            $table->boolean('is_active')->default(0);
            $table->timestamp('expires_at')->nullable();
            $table->boolean('is_read_only')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('api_access_tokens');
    }
};
