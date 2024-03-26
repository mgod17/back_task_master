<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('created_by'); 
            $table->string('title', 150);
            $table->text('description')->nullable();
            $table->enum('status', ['Pendiente', 'En proceso', 'Bloqueado', 'Completado'])->default('Pendiente'); 
            $table->unsignedBigInteger('assigned_to')->nullable();
            $table->timestamps(); 

            $table->foreign('created_by')
            ->references('id')
            ->on('users')
            ->onDelete('restrict');

            $table->foreign('assigned_to')
            ->references('id')
            ->on('users')
            ->onDelete('set null');
            });
    }

    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
