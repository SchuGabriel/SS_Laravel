<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;
    protected $table = 'Produto';

    public function cod_similar()
    {
        return $this->hasMany(Cod_Similar::class);
    }

    public function grupo()
    {
        return $this->belongsToMany(Grupo::class, 'grupo_produto')->withPivot('grupo_id');
    }
}
