<?php

namespace App\Http\Controllers;

use App\Models\ItemInventario;
use App\Repositories\ItemInventario\ItemInventarioRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ItemInventarioController extends Controller
{
    public function addItens(Request $request, ItemInventarioRepository $addItens, $id)
    {
        $addItensInventario = $addItens->addItens($request, $id);

        return $addItensInventario;
    }

    public function trocarItens(Request $request, ItemInventarioRepository $trocarItens)
    {
        $trocarItensInventario = $trocarItens->trocarItens($request);

        return $trocarItensInventario;
    }
}
