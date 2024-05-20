<?php

namespace Database\Seeders;

use App\Models\Explorador;
use App\Models\ItemInventario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemInventarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $exploradores = Explorador::all();

        foreach ($exploradores as $explorador) {
            ItemInventario::factory()->count(2)->create([
                'explorador_id' => $explorador->id,
            ]);
        }
    }
}
