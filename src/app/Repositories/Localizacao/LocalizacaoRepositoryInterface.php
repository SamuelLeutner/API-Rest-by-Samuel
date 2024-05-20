<?php

namespace App\Repositories\Localizacao;

interface LocalizacaoRepositoryInterface
{
    public function historico($id);
    public function salvarHistorico($latitude, $longitude, $exploradorId);
}
