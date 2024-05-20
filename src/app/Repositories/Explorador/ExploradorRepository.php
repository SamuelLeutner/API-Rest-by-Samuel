<?php

namespace App\Repositories\Explorador;

use App\Http\Controllers\HistoricoLocalizacaoController;
use App\Models\Explorador;
use App\Models\ItemInventario;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ExploradorRepository implements ExploradorRepositoryInterface
{
    public function updateLocation(Request $request, $id)
    {
        try {
            $request->validate([
                'latitude' => 'required|numeric',
                'longitude' => 'required|numeric',
            ]);

            $explorador = Explorador::findOrFail($id);

            $allowedParams = ['latitude', 'longitude'];
            $requestParams = array_keys($request->all());

            if ($requestParams !== $allowedParams) {
                return response()->json(['error' => 'Parâmetros inválidos. Apenas latitude e longitude são permitidos.'], 422);
            }

            if ($request->has('nome') || $request->has('idade')) {
                return response()->json(['error' => 'Não é permitido atualizar informações pessoais.'], 422);
            }

            $explorador->latitude = $request->input('latitude');
            $explorador->longitude = $request->input('longitude');
            $explorador->save();

            $exploradorId = $explorador->id;

            $historico_localizacao = new HistoricoLocalizacaoController();
            $historico_localizacao->salvarHistorico($explorador->latitude, $explorador->longitude, $exploradorId);

            return response()->json([
                'mensagem' => 'Localização atualizada com sucesso',
                'Nova localização' => [
                    'latitude' => $explorador->latitude,
                    'longitude' => $explorador->longitude,
                ],
            ], 200);
        } catch (ValidationException $e) {
            return response()->json(['error' => 'Erro de validação: ' . $e->getMessage()], 422);
        } catch (ModelNotFoundException) {
            return response()->json(['error' => 'Explorador não encontrado'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro inesperado: ' . $e->getMessage()], 500);
        }
    }

    public function showExplorador()
    {
        try {
            $explorador = auth()->user();

            if ($explorador instanceof Explorador) {
                $inventario = ItemInventario::where('explorador_id', $explorador->id)->get();

                return [
                    'Explorador' => $explorador,
                    'Inventario' => $inventario
                ];
            } else {
                return response()->json(['error' => 'Usuário não é um explorador'], 403);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro inesperado: ' . $e->getMessage()], 500);
        }
    }

    public function relatorios()
    {
        try {
            $valorMedio = ItemInventario::avg('valor');

            $valorMedio = number_format($valorMedio, 2);

            $valorSuperior = ItemInventario::where('valor', '>', 100)->pluck('id');

            $detalheDoItem = ItemInventario::whereIn('id', $valorSuperior)->get();

            return response()->json([
                'Valor médio' => $valorMedio,
                'Valor superior a 100' => $detalheDoItem,
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro inesperado: ' . $e->getMessage()], 500);
        }
    }
}
