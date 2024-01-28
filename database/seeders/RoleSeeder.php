<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = ['Empleado', 'Supervisor','Administrador','SuperAdministrador',];
        foreach ($roles as $rol) {
            DB::table('roles')->insert([
                'name' => $rol
            ]);
        }
    }
}
