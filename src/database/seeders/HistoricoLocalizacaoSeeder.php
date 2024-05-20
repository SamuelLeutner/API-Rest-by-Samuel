<?php

namespace Database\Seeders;

use App\Models\Explorador;
use App\Models\HistoricoLocalizacao;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HistoricoLocalizacaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $exploradores = Explorador::all();

        foreach ($exploradores as $explorador) {
            HistoricoLocalizacao::factory()->count(2)->create([
                'explorador_id' => $explorador->id,
            ]);
        }
    }
}
