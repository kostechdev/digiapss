<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('berita', function (Blueprint $table) {
            $table->index('kategori');
            $table->index('judul');
            $table->index('created_at');
            $table->index('penulis');
        });
    }

    public function down(): void
    {
        Schema::table('berita', function (Blueprint $table) {
            $table->dropIndex(['kategori']);
            $table->dropIndex(['judul']);
            $table->dropIndex(['created_at']);
            $table->dropIndex(['penulis']);
        });
    }
};
