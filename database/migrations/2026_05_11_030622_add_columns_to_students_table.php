<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->string('prodi')->after('email');
            $table->integer('angkatan')->after('prodi');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan'])->after('angkatan');
            $table->boolean('status_lulus')->default(false)->after('jenis_kelamin');
        });
    }

    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn(['prodi', 'angkatan', 'jenis_kelamin', 'status_lulus']);
        });
    }
};