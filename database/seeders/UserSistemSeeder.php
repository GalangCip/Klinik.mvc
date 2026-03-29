<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSistemSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('user_sistem')->insert([
            ['username' => 'admin_klinik', 'password' => Hash::make('admin123'),  'level' => 'admin'],
            ['username' => 'admin_super',  'password' => Hash::make('super123'),  'level' => 'admin'],
            ['username' => 'admin_ops',    'password' => Hash::make('ops12345'),  'level' => 'admin'],
            ['username' => 'dr_budi',      'password' => Hash::make('dokter123'), 'level' => 'dokter'],
            ['username' => 'dr_sari',      'password' => Hash::make('dokter456'), 'level' => 'dokter'],
            ['username' => 'dr_rahman',    'password' => Hash::make('rahman123'), 'level' => 'dokter'],
            ['username' => 'dr_putri',     'password' => Hash::make('putri123'),  'level' => 'dokter'],
            ['username' => 'dr_hendra',    'password' => Hash::make('hendra456'), 'level' => 'dokter'],
            ['username' => 'dr_maya',      'password' => Hash::make('maya789'),   'level' => 'dokter'],
            ['username' => 'dr_fajar',     'password' => Hash::make('fajar321'),  'level' => 'dokter'],
        ]);
    }
}