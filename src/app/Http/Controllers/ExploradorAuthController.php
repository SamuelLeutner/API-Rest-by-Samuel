<?php

namespace App\Http\Controllers;

use App\Repositories\Explorador\ExploradorAuthRepository;
use Illuminate\Http\Request;

class ExploradorAuthController extends Controller
{
    public function registro(Request $request, ExploradorAuthRepository $addExplorador)
    {
        $explorador = $addExplorador->addExplorador($request);

        return $explorador;

    }

    public function login(Request $request, ExploradorAuthRepository $loginExplorador)
    {
        $explorador = $loginExplorador->loginExplorador($request);

        return $explorador;
    }

}
