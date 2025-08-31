<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('galeris', function (Blueprint $table) {
            if (! Schema::hasColumn('galeris', 'tanggal_kegiatan')) {
                return;
            }
            $table->index('tanggal_kegiatan');
            $table->index('created_at');
            $table->index('judul');
        });
    }

    public function down(): void
    {
        Schema::table('galeris', function (Blueprint $table) {
            $table->dropIndex(['tanggal_kegiatan']);
            $table->dropIndex(['created_at']);
            $table->dropIndex(['judul']);
        });
    }
};
