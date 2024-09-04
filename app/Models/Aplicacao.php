<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aplicacao extends Model
{
    use HasFactory;
    protected $table = 'aplicacao';

    public function modelos(){
        return $this->belongsToMany(Modelo::class, 'aplicacao_modelo', 'aplicacao_id', 'modelo_id');
    }

    public function motores(){
        return $this->belongsToMany(Motor::class, 'aplicacao_motor', 'aplicacao_id', 'motor_id');
    }

    public function posicao(){
        return $this->belongsTo(Posicao::class);
    }
}
