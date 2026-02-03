<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Profile;
use App\Models\Faculty;//importamos el modelo
class Estudiante extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'facultad', 'correo', 'telefono'];

    public function profile(){//relacionando hacia Profiles
        return $this->hasOne(Profile::class);
    }

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }


    public function courses(){
        return $this->belongsToMany(Course::class);
    }
//    public function profile(){
////        return $this->hasOne('App\Models\Profile');
//        return $this->hasOne(Profile::class);
//    }
}
