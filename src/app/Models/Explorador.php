<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Explorador extends Model
{
    use HasFactory, HasApiTokens;
    protected $table = 'exploradores';

    protected $fillable = [
        'nome', 'idade', 'latitude', 'longitude', 'usuario', 'senha',
    ];

    public function itemInventarios()
    {
        return $this->hasMany(ItemInventario::class);
    }

    public function historicoLocalizacao()
    {
        return $this->hasMany(HistoricoLocalizacao::class);
    }
}
