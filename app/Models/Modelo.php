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
}
