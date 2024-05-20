<?php

namespace App\Repositories\ItemInventario;

use App\Http\Controllers\HistoricoLocalizacaoController;
use App\Models\Explorador;
use App\Models\ItemInventario;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ItemInventarioRepository implements ItemInventarioRepositoryInterface
{
    public function addItens(Request $request, $id)
    {
        try {
            $request->validate([
                'nome' => 'required|string',
                'valor' => 'required|numeric',
                'latitude' => 'required|numeric',
                'longitude' => 'required|numeric',
            ]);

            $user = auth()->user();

            if ($user instanceof Explorador) {
                $explorador = $user;
            } else {
                $explorador = Explorador::findOrFail($id);
            }

            $itemExistente = ItemInventario::where('nome', $request->input('nome'))
                ->where('explorador_id', $explorador->id)
                ->first();

            if ($itemExistente) {
                return response()->json(['error' => 'Item já existe no inventário'], 422);
            }

            $item = new ItemInventario();
            $item->nome = $request->input('nome');
            $item->valor = $request->input('valor');
            $item->latitude = $request->input('latitude');
            $item->longitude = $request->input('longitude');
            $item->explorador_id = $explorador->id;
            $item->save();

            $exploradorId = $explorador->id;

            $historico_localizacao = new HistoricoLocalizacaoController();
            $historico_localizacao->salvarHistorico($explorador->latitude, $explorador->longitude, $exploradorId);

            return response()->json([
                'Mensagem' => 'Item adicionado ao inventário com sucesso',
                'Novo item' => $item,
            ], 201);
        }catch (ValidationException $e) {
            return response()->json(['error' => 'Erro de validação: ' . $e->getMessage()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro inesperado: ' . $e->getMessage()], 500);
        }
    }


    public function trocarItens(Request $request)
    {
        try {
            $request->validate([
                'explorador_origem_id' => 'required|exists:exploradores,id',
                'explorador_destino_id' => 'required|exists:exploradores,id',
                'itens_origem' => 'required|array',
                'itens_destino' => 'required|array',
            ]);

            $exploradorOrigemId = $request->input('explorador_origem_id');
            $exploradorDestinoId = $request->input('explorador_destino_id');
            $itensOrigem = $request->input('itens_origem');
            $itensDestino = $request->input('itens_destino');

            $origemItensValidos = ItemInventario::whereIn('id', $itensOrigem)
                ->where('explorador_id', $exploradorOrigemId)
                ->get();

            if ($origemItensValidos->count() !== count($itensOrigem)) {
                return response()->json(['error' => 'Alguns itens de origem não pertencem ao explorador de origem.'], 422);
            }

            $destinoItensValidos = ItemInventario::whereIn('id', $itensDestino)
                ->where('explorador_id', $exploradorDestinoId)
                ->get();

            if ($destinoItensValidos->count() !== count($itensDestino)) {
                return response()->json(['error' => 'Alguns itens de destino não pertencem ao explorador de destino.'], 422);
            }

            ItemInventario::whereIn('id', $itensOrigem)->update(['explorador_id' => $exploradorDestinoId]);
            ItemInventario::whereIn('id', $itensDestino)->update(['explorador_id' => $exploradorOrigemId]);

            return response()->json(['mensagem' => 'Troca de itens realizada com sucesso.'], 200);
        } catch (ValidationException $e) {
            return response()->json(['error' => 'Erro de validação: ' . $e->getMessage()], 422);
        } catch (ModelNotFoundException) {
            return response()->json(['error' => 'Explorador não encontrado'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro inesperado: ' . $e->getMessage()], 500);
        }
    }
}
