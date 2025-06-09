<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');  // Remove ->unique() for now
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
        
        // Add unique constraint separately
        Schema::table('users', function (Blueprint $table) {
            $table->unique('email');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};