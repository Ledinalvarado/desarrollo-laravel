<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Profile;
class Estudiante extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'facultad', 'correo', 'telefono'];

    public function profile(){
//        return $this->hasOne('App\Models\Profile');
        return $this->hasOne(Profile::class);
    }
}
