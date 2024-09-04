<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    use HasFactory;

    protected $table = 'Modelo';

    public function montadora(){
        return $this->belongsTo(Montadora::class);
    }
    
    public function aplicacoes(){
        return $this->belongsToMany(Aplicacao::class, 'aplicacao_modelo', 'modelo_id', 'aplicacao_id');
    }
}
