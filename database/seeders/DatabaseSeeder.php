<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Sucursal;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Sucursal::factory(10)->create();
        Categoria::factory(100)->create();
        Producto::factory(200)->create();
        Proveedor::factory(20)->create();

        User::factory()->create([
            'name' => 'rayder123',
            'email' => 'mrayderalfredo@gmail.com',
            'password' => bcrypt('rayder123') // Cambia 'password' por la contraseña que
        ]);
    }
}
