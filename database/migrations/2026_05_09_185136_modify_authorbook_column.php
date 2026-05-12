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
       Schema::table('authorbook', function (Blueprint $table) {
            $table->unique(['author_id', 'book_iSBN']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('authorbook', function (Blueprint $table) {
            $table->dropUnique(['author_id', 'book_iSBN']);
        });
    }
};
