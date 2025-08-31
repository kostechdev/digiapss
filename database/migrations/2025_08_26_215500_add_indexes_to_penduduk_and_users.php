<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('penduduk', function (Blueprint $table) {
            $table->index('nama');
            $table->index('tanggal_lahir');
            $table->index('jenis_kelamin');
            $table->index('agama');
            $table->index('status_perkawinan');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->index('role');
        });
    }

    public function down(): void
    {
        Schema::table('penduduk', function (Blueprint $table) {
            $table->dropIndex(['nama']);
            $table->dropIndex(['tanggal_lahir']);
            $table->dropIndex(['jenis_kelamin']);
            $table->dropIndex(['agama']);
            $table->dropIndex(['status_perkawinan']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['role']);
        });
    }
};
