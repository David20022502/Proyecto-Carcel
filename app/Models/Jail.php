<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Jail extends Model
{
    //relacion de uno a muchos
    //una carcel le pertence a un pabellon
    public function ward(){
        return $this->belongsTo(Ward::class);
    }
    //relacion de muchos a muchos  
    public function users(){
        return $this->belongsToMany(User::class)->withTimestamps();
    }
    //relacion polimorfica uno a uno 
    //una carcel puede tener una imagen
    public function image(){
        return $this->morphTo(Image::class,'imageable');
    }

    use HasFactory;
}
