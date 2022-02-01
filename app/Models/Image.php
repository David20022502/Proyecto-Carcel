<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Image extends Model
{
    protected $fillable = ['path'];
    //relacion poliformica uno a uno
    //una imagen le pertenece aun usuario, reporte, pabellon o carcel
    public function imageable(){
        return $this->morphTo();
    }
    public function getUrl(): string
    {
        return Str::startsWith($this->path, 'https://')
            ? $this->path
            : Storage::url($this->path);
    }

    use HasFactory;
}
