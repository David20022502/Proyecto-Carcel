<?php

namespace App\Models;

use App\Traits\HasImage;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasImage;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
      protected $fillable = [
        'role_id',
        'first_name',
        'last_name',
        'username',
        'personal_phone',
        'home_phone',
        'address',
        'password',
        'email',
        'birthdate',
    ];
    //relacion de uno a muchos
    // un usuario le pertenece un rol 
    public function role(){
        return $this->belongsTo(Role::class);
    }

    //relacion de uno a muchos
    //un usuario pude realizar muchos reportes

    public function reports(){
        return $this->hasMany(Report::class);
    }

    //relacion de muchos a muchs
    //un usario pude estar en varios pabellones 
    public function wards(){
        return $this->belongsToMany(Ward::class)->withTimestamps();
    }

    //relacion de muhcos a muchos 
    //un usario puede estar en varias carceles

    public function jails(){
        return $this->belongsToMany(Jail::class)->withTimestamps;
    }

    //relacion polimorfica de uno a uno 
    //un usario puede tener una imagen 

    public function image(){
        return $this->morphOne(Image::class,'imageable');
    }

    public function getFullName() {
        
        $fullName ="$this->first_name  $this->last_name";
        return $fullName;
    }
    public function getBirthdateAttribute($value): ?string
    {
        return isset($value) ? Carbon::parse($value)->format('d/m/Y') : null;
    }
    public function generateAvatarUrl(): string
    {
        $ui_avatar_api = "https://ui-avatars.com/api/?name=*+*&size=128";

        return Str::replaceArray(
            '*',
            [
                $this->first_name,
                $this->last_name
            ],
            $ui_avatar_api
        );
    }
    public function hasRole(string $role)
    {
        return $this->role->name === $role;
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];












    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
