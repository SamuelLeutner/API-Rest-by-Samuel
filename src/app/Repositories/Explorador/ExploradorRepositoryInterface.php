<?php

namespace App\Repositories\Explorador;

use Illuminate\Http\Request;

interface ExploradorRepositoryInterface
{
    public function updateLocation(Request $request, $id);
    public function showExplorador();
    public function relatorios();
}
