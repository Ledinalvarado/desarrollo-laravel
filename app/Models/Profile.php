<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Estudiante;//importando el modelo de Estudiante
class Profile extends Model
{
    use HasFactory;
    // agregamos los campos que pueden ser editados usando un formulario
    protected $fillable = ['address','birth_date'];

    public function student(){//relacionar hacia el modelo de Estudiante
        return $this->belongsTo(Estudiante::class);
    }


//    public function student(){
//        return $this->belongsTo(Estudiante::class);
//    }
}
