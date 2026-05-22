<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TipeKamar>
 */
class TipeKamarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_tipe' => $this->faker->randomElement(['Standard Room', 'Deluxe Room', 'Suite Room']),
            'harga_per_malam' => $this->faker->randomElement([250000, 500000, 750000]),
            'kapasitas' => $this->faker->randomElement([1, 2, 3, 4]),
            'fasilitas' => $this->faker->sentence(),
            'deskripsi' => $this->faker->paragraph(),
            'foto' => null,
        ];
    }
}
