<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    public function run(): void
    {
        $names = [
            'Dompet Kulit Hitam',
            'Kunci Motor Honda',
            'Tas Ransel Biru',
            'Flashdisk 32GB',
            'Kartu Mahasiswa',
            'Earphone Putih',
            'Jaket Almamater',
            'Botol Minum Hijau',
        ];

        $locations = [
            'Perpustakaan Pusat',
            'Kantin Utama',
            'Gedung A Lantai 2',
            'Parkiran Motor',
            'Lapangan Basket',
            'Masjid Kampus',
        ];

        // 20 data untuk setiap status: lost, found, dan selesai (halaman History)
        foreach (['lost', 'found', 'selesai'] as $status) {
            for ($i = 1; $i <= 20; $i++) {
                Item::create([
                    'status' => $status,
                    'name' => $names[$i % count($names)] . ' #' . $i,
                    'description' => 'Data contoh nomor ' . $i . ' untuk menguji pagination.',
                    'location' => $locations[$i % count($locations)],
                    'date' => now()->subDays($i)->toDateString(),
                    'contact' => '081234567890',
                    'image_url' => null,
                    'user_id' => null,
                ]);
            }
        }
    }
}