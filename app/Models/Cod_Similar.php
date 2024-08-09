<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cod_Similar extends Model
{
    use HasFactory;
    protected $table = 'cod_similar';

    public function produto(){
        return $this->belongsTo(Produto::class);
    }

}
