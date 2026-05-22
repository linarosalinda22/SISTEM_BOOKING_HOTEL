<?php

namespace Database\Factories;

use App\Models\TipeKamar;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kamar>
 */
class KamarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nomor_kamar' => $this->faker->unique()->numerify('###'),
            'tipe_kamar_id' => TipeKamar::factory(),
            'lantai' => $this->faker->numberBetween(1, 5),
            'status_kamar' => $this->faker->randomElement(['Tersedia', 'Terisi', 'Maintenance']),
        ];
    }
}
