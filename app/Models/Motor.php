<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motor extends Model
{
    use HasFactory;
    protected $table = 'Motor';

    public function aplicacoes(){
        return $this->belongsToMany(Aplicacao::class, 'aplicacao_motor', 'motor_id', 'aplicacao_id');
    }
}