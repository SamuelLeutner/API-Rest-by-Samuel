<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemInventario extends Model
{
    use HasFactory;

    protected $table = 'item_inventarios';

    protected $fillable = ['nome', 'valor', 'latitude', 'longitude', 'explorador_id'];

    public function explorador()
    {
        return $this->belongsTo(Explorador::class);
    }
}
