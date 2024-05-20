<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Explorador;
use Database\Factories\ExploradorFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        ExploradorFactory::factoryForModel(Explorador::class)->count(2)->create();

        $this->call([
            HistoricoLocalizacaoSeeder::class,
        ]);

        $this->call([
            ItemInventarioSeeder::class,
        ]);
    }
}
