<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AuthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Criar administradores primeiro
        $admin1 = Admin::create([
            'name' => 'Admin Sistema',
            'email' => 'admin@test.com',
            'password' => Hash::make('admin123')
        ]);

        $admin2 = Admin::create([
            'name' => 'Super Admin',
            'email' => 'super@test.com',
            'password' => Hash::make('super123')
        ]);

        // Criar usuários associados aos administradores
        User::create([
            'name' => 'João Silva',
            'email' => 'user@test.com',
            'password' => Hash::make('password'),
            'cpf' => '12345678901',
            'position' => 'Desenvolvedor',
            'birth_date' => '1990-05-15',
            'cep' => '01234-567',
            'street' => 'Rua das Flores',
            'number' => '123',
            'complement' => 'Apto 45',
            'district' => 'Centro',
            'city' => 'São Paulo',
            'state' => 'SP',
            'admin_id' => $admin1->id
        ]);

        User::create([
            'name' => 'Maria Santos',
            'email' => 'maria@test.com',
            'password' => Hash::make('password'),
            'cpf' => '98765432109',
            'position' => 'Designer',
            'birth_date' => '1985-08-22',
            'cep' => '09876-543',
            'street' => 'Av. Principal',
            'number' => '456',
            'complement' => '',
            'district' => 'Vila Nova',
            'city' => 'Rio de Janeiro',
            'state' => 'RJ',
            'admin_id' => $admin2->id
        ]);
    }
}