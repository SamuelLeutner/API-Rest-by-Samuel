<?php

namespace Database\Seeders;

use App\Models\Explorador;
use App\Models\HistoricoLocalizacao;
use App\Models\ItemInventario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExploradoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $explorador1 = Explorador::factory()->create();
        $explorador2 = Explorador::factory()->create();

        HistoricoLocalizacao::factory()->count(5)->create([
            'explorador_id' => $explorador1->id,
        ]);

        HistoricoLocalizacao::factory()->count(3)->create([
            'explorador_id' => $explorador2->id,
        ]);

        ItemInventario::factory()->count(2)->create([
            'explorador_id' => $explorador1->id,
        ]);

        ItemInventario::factory()->count(2)->create([
            'explorador_id' => $explorador2->id,
        ]);
    }
}
