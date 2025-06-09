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
        Schema::create('tasks', function (Blueprint $table) {
        $table->id();                                                       // Unique ID for each task
        $table->foreignId('user_id')->constrained()->onDelete('cascade');   // Foreign key to link tasks to users, with cascade delete
        $table->string('title');                                            // Task name (e.g., "Buy groceries")
        $table->text('description')->nullable();                            // Optional task details
        $table->boolean('completed')->default(false);                       // Whether the task is done
        $table->timestamps();                                               // Auto-generated timestamps (created_at & updated_at)
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
