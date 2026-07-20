<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat role admin dan staff
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $staffRole = Role::firstOrCreate(['name' => 'staff']);

        // Buat akun admin default
        $admin = User::firstOrCreate(
            ['email' => 'admin@gudangsportcar.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('mobildumbo14'),
                'email_verified_at' => now(), // langsung terverifikasi, tanpa perlu klik link email
            ]
        );
        $admin->assignRole($adminRole);

        // Buat akun staff default
        $staff = User::firstOrCreate(
            ['email' => 'staff@gudangmobil.com'],
            [
                'name' => 'Staff Gudang',
                'password' => Hash::make('wartegmobil18'),
                'email_verified_at' => now(),
            ]
        );
        $staff->assignRole($staffRole);
    }
}