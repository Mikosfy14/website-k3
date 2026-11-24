<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Kredensial admin TIDAK boleh hardcode di kode. Isi ADMIN_EMAIL dan
     * ADMIN_PASSWORD di .env sebelum menjalankan seeder ini. Kalau
     * ADMIN_PASSWORD tidak diisi, password acak akan dibuat dan
     * ditampilkan sekali di output console.
     */
    public function run(): void
    {
        $email = env('ADMIN_EMAIL', 'admin@example.com');
        $password = env('ADMIN_PASSWORD');

        $generated = false;
        if (empty($password)) {
            $password = Str::password(16);
            $generated = true;
        }

        User::updateOrCreate(
            ['email' => $email],
            [
                'name' => 'Admin User',
                'password' => Hash::make($password),
                'role' => 'admin',
            ]
        );

        if ($generated) {
            $this->command?->warn("Admin dibuat dengan password acak: {$password}");
            $this->command?->warn('Simpan password ini sekarang - tidak akan ditampilkan lagi.');
        }
    }
}
