<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Montadora extends Model
{
    use HasFactory;

    protected $table = 'Montadora';

    public function modelo(){
        return $this->hasMany(Modelo::class);
    }
}
