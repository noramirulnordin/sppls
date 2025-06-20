<?php
namespace Database\Seeders;

use App\Models\Balak;
use App\Models\Kawasan;
use App\Models\Lori;
use App\Models\Pembeli;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name'     => 'Admin',
            'email'    => 'admin@sppls.com',
            'password' => bcrypt('12345678'),
            'is_admin' => true,
        ]);

        for ($i = 1; $i <= 10; $i++) {
            Balak::factory()->create([
                'jenis_pokok' => 'Balak ' . $i,
                'panjang'     => fake()->numberBetween(5, 20),
                'diameter'    => fake()->numberBetween(10, 50),
            ]);
        }

        for ($i = 1; $i <= 5; $i++) {
            Pembeli::factory()->create([
                'nama'   => fake()->name(),
                'no_hp'  => fake()->phoneNumber(),
                'alamat' => fake()->address(),
                'email'  => fake()->unique()->safeEmail(),
            ]);
        }

        for ($i = 0; $i < 5; $i++) {
            Lori::factory()->create([
                'no_pendaftaran' => fake()->unique()->numberBetween(1000, 9999),
                'pembeli_id'     => fake()->numberBetween(1, 5),
            ]);
        }

        for ($i = 0; $i < 5; $i++) {
            Kawasan::factory()->create([
                'nama'      => 'Kawasan ' . ($i + 1),
                'alamat'    => fake()->address(),
                'no_permit' => strtoupper(fake()->lexify('???')) . fake()->unique()->numberBetween(10000, 99999),
            ]);
        }

        for ($i = 0; $i < 5; $i++) {
            $kawasan = Kawasan::inRandomOrder()->first();
            $lori    = Lori::inRandomOrder()->take(rand(1, 3))->pluck('id');
            $kawasan->lori()->attach($lori);
        }
    }
}
