<?php

namespace App\Http\Controllers;

use App\Repositories\Explorador\ExploradorRepository;
use Illuminate\Http\Request;

class ExploradorController extends Controller
{
    public function update(Request $request, ExploradorRepository $update, $id)
    {
        $explorador = $update->updateLocation($request, $id);

        return $explorador;
    }

    public function show(ExploradorRepository $showExplorador)
    {
        $show = $showExplorador->showExplorador();

        return $show;
    }

    public function relatorios(ExploradorRepository $mostrarRelatorios)
    {
        $relalatorios = $mostrarRelatorios->relatorios();

        return $relalatorios;
    }
}
