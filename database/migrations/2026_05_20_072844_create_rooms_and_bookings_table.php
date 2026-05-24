<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('room_number')->unique();
            $table->enum('type', ['standard', 'deluxe', 'suite', 'villa']);
            $table->decimal('price_per_night', 12, 2);
            $table->integer('max_guests')->default(2);
            $table->text('description')->nullable();
            $table->json('facilities')->nullable();
            $table->string('photo')->nullable();
            $table->enum('status', ['available', 'booked', 'maintenance'])->default('available');
            $table->timestamps();
        });

        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_code')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('room_id')->constrained()->onDelete('cascade');
            $table->date('check_in');
            $table->date('check_out');
            $table->integer('total_nights');
            $table->integer('total_guests')->default(1);
            $table->decimal('total_price', 12, 2);
            $table->enum('status', ['pending', 'confirmed', 'checked_in', 'checked_out', 'cancelled'])
                  ->default('pending');
            $table->text('special_request')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
        Schema::dropIfExists('rooms');
    }
};