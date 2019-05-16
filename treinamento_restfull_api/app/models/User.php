<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    protected $dates = ['deleted_at'];

    const VERIFIED_USER = '1';
    const UNVERIFIED_USER = '0';

    const ADMIN_USER = 'true';
    const REGULAR_USER = 'false';

    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'verified',
        'verification_token',
        'admin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'verification_token'
    ];

    public function isVerified(){
        return $this->verified == self::VERIFIED_USER;
    }

    public function isAdmin(){
        return $this->admin == self::ADMIN_USER;
    }

    public static function genetateVerificatinCode(){
        return str_random(40);
    }

    public function setNameAttribute($name){
        $this->attributes['name'] = $name;
    }

    public function getNameAttribute(){
        return ucwords($name);
    }

    public function seEmailAttribute($email){
        $this->attributes['email'] = strtolower($email);
    }
}
