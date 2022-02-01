<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    use HasFactory;
    //relacion de uno a muchos
    //un pabellon puede tener muchas carceles
    public function jails(){
        return $this->hasMany(Jail::class);
    }
    //relacion de uno a muchos
    //un pabellon puede tener muchos usuarios

    public function users(){
        return $this->belongsToMany(User::class)->withTimestamps();

    }
    //relacion polimorfica de uno a uno
    //un pabellon puede tener una imagen
    public function image(){
        return $this->morphOne(Image::class,'imageable');
    }

}
