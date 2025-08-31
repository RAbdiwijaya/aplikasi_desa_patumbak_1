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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            // $table->string('image'); // Optional image field
            // $table->unsignedBigInteger('author_id'); // For hierarchical categories
            // $table->foreign('author_id')->references('id')->on('users'); // Foreign key to users table
            // $table->foreignId('author_id')->constrained('users',indexName:'posts_author_id');
            // $table->text('body');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
