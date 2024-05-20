<?php

namespace App\Repositories\Explorador;

use App\Events\ExploradorCriado;
use App\Http\Controllers\HistoricoLocalizacaoController;
use App\Models\Explorador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ExploradorAuthRepository implements ExploradorAuthRepositoryInterface
{
    public function addExplorador(Request $request)
    {
        try {
            $request->validate([
                'nome' => 'required|string',
                'idade' => 'required|numeric',
                'latitude' => 'required|numeric',
                'longitude' => 'required|numeric',
                'usuario' => 'required|unique:exploradores',
                'senha' => 'required|min:6',
            ]);

            $explorador = new Explorador();
            $explorador->nome = $request->input('nome');
            $explorador->idade = $request->input('idade');
            $explorador->latitude = $request->input('latitude');
            $explorador->longitude = $request->input('longitude');
            $explorador->usuario = $request->input('usuario');
            $explorador->senha = bcrypt($request->input('senha'));
            $explorador->save();

            event(new ExploradorCriado($explorador));

            $exploradorId = $explorador->id;

            $historico_localizacao = new HistoricoLocalizacaoController();
            $historico_localizacao->salvarHistorico($explorador->latitude, $explorador->longitude, $exploradorId);

            return response()->json(['explorador' => $explorador], 201);

        } catch (ValidationException $e) {
            return response()->json(['error' => 'Erro de validação: ' . $e->getMessage()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro inesperado ao criar o explorador: ' . $e->getMessage()], 500);
        }
    }

    public function loginExplorador(Request $request)
    {
        try {
            $request->validate([
                'usuario' => 'required|string',
                'senha' => 'required|string',
            ]);

            $explorador = Explorador::where('usuario', $request->input('usuario'))->first();

            if (!$explorador || !Hash::check($request->input('senha'), $explorador->senha)) {
                throw ValidationException::withMessages([
                    'usuario' => ['Credenciais inválidas'],
                ]);
            }

            $token = $explorador->createToken('token-name', []);

            $plainTextToken = $token->plainTextToken;

            return response()->json(['Seu token de login' => $plainTextToken], 200);
        } catch (ValidationException $e) {
            return response()->json(['message' => $e->getMessage()], 401);
        }
    }
}
