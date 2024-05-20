<?php

namespace App\Repositories\Localizacao;

use App\Models\Explorador;
use App\Models\HistoricoLocalizacao;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LocalizacaoRepository implements LocalizacaoRepositoryInterface
{
    public function historico($id)
    {
        try {
            $explorador = Explorador::findOrFail($id);

            $historico = HistoricoLocalizacao::where('explorador_id', $explorador->id)->get();

            return response()->json(['historico' => $historico]);
        } catch (ModelNotFoundException) {
            return response()->json(['error' => 'Explorador não encontrado'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro inesperado: ' . $e->getMessage()], 500);
        }
    }

    public function salvarHistorico($latitude, $longitude, $exploradorId)
    {
        $historico = new HistoricoLocalizacao();

        $historico->latitude = $latitude;
        $historico->longitude = $longitude;
        $historico->explorador_id = $exploradorId;

        $historico->save();
    }
}
