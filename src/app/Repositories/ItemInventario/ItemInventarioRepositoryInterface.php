<?php

namespace App\Repositories\ItemInventario;

use Illuminate\Http\Request;

interface ItemInventarioRepositoryInterface
{
    public function addItens(Request $request, $id);
    public function trocarItens(Request $request);
}
