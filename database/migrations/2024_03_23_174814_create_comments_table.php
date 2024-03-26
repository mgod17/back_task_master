<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('task_id');
            $table->string('content', 255);
            $table->timestamps();

            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('set null');

            $table->foreign('task_id')
            ->references('id')
            ->on('tasks')
            ->onDelete('cascade');
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};