<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Empresa;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Empresa::insert([
            [
                'nombre' => 'Pandasoft',
                'descripcion' => 'Empresa principal',
                'logo' => 'pandasoft.jpg',
            ],
            [
                'nombre' => 'Servcom',
                'descripcion' => 'Servicios y soluciones',
                'logo' => 'servcom.jpg',
            ],
            [
                'nombre' => 'Apix',
                'descripcion' => 'Soluciones eficientes',
                'logo' => 'apix.jpg',
            ],
        ]);
    }
}
