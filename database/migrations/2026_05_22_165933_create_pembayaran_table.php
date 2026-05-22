<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayaran', function (Blueprint $table) {

            $table->id();

            $table->foreignId('booking_id')
                  ->constrained('booking')
                  ->onDelete('cascade');

            $table->date('tanggal_pembayaran');

            $table->string('metode_pembayaran');

            $table->decimal('total_bayar', 12, 2);

            $table->enum('status_pembayaran', [
                'Lunas',
                'Belum Lunas'
            ])->default('Belum Lunas');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};