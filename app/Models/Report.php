<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    //relacion de uno a muchos
    //un reporte le pertence a un usario
    public function user(){
        return $this->belongsTo(User::class);
    }
    //relacion polimorfica uno a uno
    //un reporte pude tener una imagen

    public function image(){
        return $this->morphOne(Image::class,'imageable');
    }
}
