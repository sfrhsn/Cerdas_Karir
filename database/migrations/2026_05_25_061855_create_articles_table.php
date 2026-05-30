<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // penulis (admin)
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category'); // CV Writing, Interview Tips, dll
            $table->string('thumbnail')->nullable();
            $table->text('excerpt');
            $table->longText('content');
            $table->integer('read_time')->default(5); // menit
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_published')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};