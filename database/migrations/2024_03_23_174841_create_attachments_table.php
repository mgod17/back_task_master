<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
{
    Schema::create('attachments', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('task_id'); 
        $table->unsignedBigInteger('user_id'); 
        $table->string('file_path'); 
        $table->timestamps();

        $table->foreign('task_id')
        ->references('id')
        ->on('tasks')
        ->onDelete('cascade')
        ;

        $table->foreign('user_id')
        ->references('id')
        ->on('users')
        ->onDelete('set null');
    });
}

    public function down(): void
    {
        Schema::dropIfExists('attachments');
    }
};
