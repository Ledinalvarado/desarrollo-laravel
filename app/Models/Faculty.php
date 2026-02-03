<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Estudiante;
class Faculty extends Model
{
    use HasFactory;

    public function students(){
        return $this->hasMany(Estudiante::class);
    }


}
