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
        // ========== 1 =========
        // Create books table with necessary fields
        // Fields: id, title, author, published_year, is_available, created_at, updated_at
        Schema::create('books', function (Blueprint $table) {
<<<<<<< HEAD
            $table->id();
            $table->string('title');
            $table->string('author');
            $table->smallInteger('published_year')->nullable();
            $table->boolean('is_available')->default(true);
            $table->timestamps();
=======

>>>>>>> 0dfb2fa5e1f9378ad8fdbf5708fc33b3dc077aca
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
