<?php

namespace App\Repositories\Explorador;

use Illuminate\Http\Request;

interface ExploradorAuthRepositoryInterface
{
    public function addExplorador(Request $request);
    public function loginExplorador(Request $request);
}
