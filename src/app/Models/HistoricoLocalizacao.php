<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoricoLocalizacao extends Model
{
    use HasFactory;

    protected $table = 'historico_localizacoes';

    protected $fillable = [
        'latitude', 'longitude', 'explorador_id',
    ];

    public $timestamps = false;

    public function explorador()
    {
        return $this->belongsTo(Explorador::class);
    }
}
