<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('task', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');
            $table->string('title'); 
            $table->text('description')->nullable(); 
            $table->foreignId('category_id') 
                ->constrained('categories')
                ->onDelete('cascade'); 
            $table->enum('priority', ['low', 'medium', 'high']); 
            $table->boolean('is_completed')->default(false); 
            $table->timestamp('due_date')->nullable(); 
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task');
    }
};
