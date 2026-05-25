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
        Schema::create('kamar', function (Blueprint $table) {

            $table->id();

            // Nomor kamar
            $table->string('nomor_kamar')->unique();

            // Relasi ke tabel tipe_kamar
            $table->foreignId('tipe_kamar_id')
                  ->constrained('tipe_kamars')
                  ->onDelete('cascade');

            // Harga kamar
            $table->decimal('harga', 12, 2);

            // Status kamar
            $table->enum('status_kamar', [
                'Tersedia',
                'Terisi',
                'Maintenance'
            ])->default('Tersedia');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kamar');
    }
};