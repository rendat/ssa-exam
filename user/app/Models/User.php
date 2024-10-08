<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'prefixname', 'firstname', 'middlename', 'lastname', 'suffixname', 'username', 'email', 'password', 'photo',
    ];
    

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

 

    public function getAvatarAttribute()
    {
        return $this->photo ? asset('storage/' . $this->photo) : asset('/storage/p2.png');
    }
    
    
    
public function getFullnameAttribute()
{
    $middleInitial = $this->middleinitial;
    return "{$this->prefixname}. {$this->firstname} {$middleInitial} {$this->lastname} {$this->suffixname}";
}

// Accessor for middle initial
public function getMiddleinitialAttribute()
{
    if ($this->middlename) {
        return strtoupper(substr($this->middlename, 0, 1)) . '.';
    }
    return '';
}

    
}
