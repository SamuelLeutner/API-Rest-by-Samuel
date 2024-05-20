<?php

namespace App\Providers;

use App\Repositories\Explorador\ExploradorAuthRepository;
use App\Repositories\Explorador\ExploradorAuthRepositoryInterface;
use App\Repositories\Explorador\ExploradorRepository;
use App\Repositories\Explorador\ExploradorRepositoryInterface;
use App\Repositories\ItemInventario\ItemInventarioRepository;
use App\Repositories\ItemInventario\ItemInventarioRepositoryInterface;
use App\Repositories\Localizacao\LocalizacaoRepository;
use App\Repositories\Localizacao\LocalizacaoRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class APIServicesProvider extends ServiceProvider
{
    public array $bindings = [
        ExploradorAuthRepositoryInterface::class => ExploradorAuthRepository::class,
        ExploradorRepositoryInterface::class => ExploradorRepository::class,

        LocalizacaoRepositoryInterface::class => LocalizacaoRepository::class,

        ItemInventarioRepositoryInterface::class => ItemInventarioRepository::class,
    ];

}
