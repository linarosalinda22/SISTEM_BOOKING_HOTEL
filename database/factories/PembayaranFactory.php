<?php

namespace Database\Factories;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pembayaran>
 */
class PembayaranFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $booking = Booking::inRandomOrder()->first() ?? Booking::factory()->create();

        return [
            'booking_id' => $booking->id,
            'tanggal_pembayaran' => $this->faker->dateTimeBetween('-30 days', 'now'),
            'metode_pembayaran' => $this->faker->randomElement(['Transfer Bank', 'Cash', 'E-Wallet']),
            'total_bayar' => $booking->total_harga,
            'status_pembayaran' => $this->faker->randomElement(['Lunas', 'Belum Lunas']),
        ];
    }
}
