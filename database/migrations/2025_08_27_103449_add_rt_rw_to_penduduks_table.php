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
        Schema::table('penduduk', function (Blueprint $table) {
            $table->foreignId('rt_id')->nullable()->constrained('rts')->onDelete('set null');
            $table->foreignId('rw_id')->nullable()->constrained('rws')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penduduk', function (Blueprint $table) {
            $table->dropForeign(['rt_id']);
            $table->dropForeign(['rw_id']);
            $table->dropColumn(['rt_id', 'rw_id']);
        });
    }
};
