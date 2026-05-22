<?php

namespace Database\Factories;

use App\Models\Kamar;
use App\Models\Tamus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $checkin = $this->faker->dateTimeBetween('-30 days', '+30 days');
        $checkout = \Carbon\Carbon::instance($checkin)->addDays($this->faker->numberBetween(1, 10));
        $lama_menginap = $checkout->diffInDays($checkin);
        $kamar = Kamar::inRandomOrder()->first() ?? Kamar::factory()->create();

        return [
            'tamu_id' => Tamus::inRandomOrder()->first()?->id ?? Tamus::factory()->create()->id,
            'kamar_id' => $kamar->id,
            'tanggal_checkin' => $checkin,
            'tanggal_checkout' => $checkout,
            'lama_menginap' => $lama_menginap,
            'total_harga' => $kamar->tipeKamar->harga_per_malam * $lama_menginap,
            'status_booking' => $this->faker->randomElement(['Pending', 'Check-in', 'Selesai', 'Dibatalkan']),
        ];
    }
}
