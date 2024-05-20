<?php

namespace App\Http\Controllers;

use App\Repositories\Localizacao\LocalizacaoRepository;

class HistoricoLocalizacaoController extends Controller
{
    public function historico(LocalizacaoRepository $historicoExplorador,$id)
    {
        $historico = $historicoExplorador->historico($id);

        return $historico;
    }

    public function salvarHistorico($latitude, $longitude, $exploradorId)
    {
        $localizacaoRepository = new LocalizacaoRepository();
        $localizacaoRepository->salvarHistorico($latitude, $longitude, $exploradorId);
    }

}
