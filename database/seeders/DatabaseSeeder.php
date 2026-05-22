<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Kamar;
use App\Models\Pembayaran;
use App\Models\Tamus;
use App\Models\TipeKamar;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@hotel.com',
            'password' => bcrypt('password'),
        ]);

        // Create Tipe Kamar (Room Types)
        $standardRoom = TipeKamar::create([
            'nama_tipe' => 'Standard Room',
            'harga_per_malam' => 250000,
            'kapasitas' => 1,
            'fasilitas' => 'AC, TV, WiFi, Kasur Single, Kamar Mandi Pribadi',
            'deskripsi' => 'Kamar standar yang nyaman untuk tamu individu dengan fasilitas dasar.',
            'foto' => null,
        ]);

        $deluxeRoom = TipeKamar::create([
            'nama_tipe' => 'Deluxe Room',
            'harga_per_malam' => 500000,
            'kapasitas' => 2,
            'fasilitas' => 'AC, Smart TV, WiFi, Kasur King Size, Kamar Mandi Mewah, Minibar',
            'deskripsi' => 'Kamar deluxe dengan desain modern dan fasilitas premium untuk kenyamanan maksimal.',
            'foto' => null,
        ]);

        $suiteRoom = TipeKamar::create([
            'nama_tipe' => 'Suite Room',
            'harga_per_malam' => 750000,
            'kapasitas' => 4,
            'fasilitas' => 'AC, Smart TV, WiFi, Kasur King Size, Ruang Tamu, Kamar Mandi Marmer, Minibar, Balkon',
            'deskripsi' => 'Kamar suite mewah dengan ruang tamu terpisah dan fasilitas premium untuk tamu VIP.',
            'foto' => null,
        ]);

        // Create Kamar (Rooms)
        for ($i = 101; $i <= 110; $i++) {
            Kamar::create([
                'nomor_kamar' => (string)$i,
                'tipe_kamar_id' => $standardRoom->id,
                'lantai' => ceil($i / 10),
                'status_kamar' => 'Tersedia',
            ]);
        }

        for ($i = 201; $i <= 210; $i++) {
            Kamar::create([
                'nomor_kamar' => (string)$i,
                'tipe_kamar_id' => $deluxeRoom->id,
                'lantai' => ceil($i / 10),
                'status_kamar' => 'Tersedia',
            ]);
        }

        for ($i = 301; $i <= 305; $i++) {
            Kamar::create([
                'nomor_kamar' => (string)$i,
                'tipe_kamar_id' => $suiteRoom->id,
                'lantai' => ceil($i / 10),
                'status_kamar' => 'Tersedia',
            ]);
        }

        // Create Tamus (Guests)
        Tamus::factory(20)->create();

        // Create Bookings
        Booking::factory(15)->create();

        // Create Pembayaran (Payments)
        Pembayaran::factory(10)->create();
    }
}
