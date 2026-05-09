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
        Schema::create('authorbook', function (Blueprint $table) {
        $table->unsignedBigInteger('author_id');
        $table->foreign('author_id')->references('id')->on('authors');
        $table->char('book_iSBN', 13);
        $table->foreign('book_iSBN')->references('iSBN')->on('books');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('authorbook');
    }
};
