<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posicao extends Model
{
    use HasFactory;
    protected $table = 'Posicao';

    public function aplicacao(){
        return $this->hasMany(Aplicacao::class);
    }
}
