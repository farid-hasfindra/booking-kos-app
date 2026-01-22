<?php

namespace Database\Seeders;

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
        // Admin User
        User::create([
            'name' => 'Admin Kos',
            'username' => 'admin',
            'email' => 'admin@kosbulinda.com',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
        ]);

        $this->call([
            LandingInfoSeeder::class,
        ]);

        $customer = User::create([
            'name' => 'Pelanggan 1',
            'username' => 'pelanggan1',
            'email' => 'customer@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'customer',
        ]);

        // Sample Rooms
        $room1 = \App\Models\Room::create([
            'name' => 'Kamar Mawar - Tipe A',
            'slug' => 'kamar-mawar-tipe-a',
            'price' => 1500000,
            'description' => 'Kamar luas dengan jendela besar menghadap taman. Sangat nyaman untuk pekerja atau mahasiswa.',
            'facilities' => 'AC, WiFi, Kamar Mandi Dalam, Kasur Queen Size, Meja Belajar, Lemari',
            'location' => 'Lantai 1',
            'status' => 'available'
        ]);

        $room2 = \App\Models\Room::create([
            'name' => 'Kamar Melati - Tipe B',
            'slug' => 'kamar-melati-tipe-b',
            'price' => 1200000,
            'description' => 'Kamar nyaman dengan pencahayaan alami yang baik.',
            'facilities' => 'Kipas Angin, WiFi, Kamar Mandi Luar, Kasur Single, Meja Belajar',
            'location' => 'Lantai 2',
            'status' => 'available'
        ]);

        \App\Models\Room::create([
            'name' => 'Kamar VIP - Suite',
            'slug' => 'kamar-vip-suite',
            'price' => 2500000,
            'description' => 'Unit paling premium dengan fasilitas lengkap dan balkon pribadi.',
            'facilities' => 'AC, Smart TV, WiFi Kencang, Water Heater, Kulkas Mini, Balkon',
            'location' => 'Lantai 3',
            'status' => 'available'
        ]);

        // Create a Booking for Customer 1 on Room 1
        \App\Models\Booking::create([
            'user_id' => $customer->id,
            'room_id' => $room1->id,
            'start_date' => now(),
            'end_date' => now()->addMonth(),
            'total_price' => $room1->price,
            'payment_status' => 'pending', // Pending payment
            'status' => 'active',
        ]);

        // Create another booking (history)
        \App\Models\Booking::create([
            'user_id' => $customer->id,
            'room_id' => $room2->id,
            'start_date' => now()->subMonth(),
            'end_date' => now(),
            'total_price' => $room2->price,
            'payment_status' => 'paid',
            'status' => 'completed',
        ]);

    }
}
