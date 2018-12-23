<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Validator;
use Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($value){
        $this->attributes['password'] = Hash::make($value);
    }

    public function book(){
        return $this->hasMany('App\Book');
    }

    public static function validate($input){
        $rules = array(
            'username'=>'required|min:3|max:20|alphanum|unique:users',
            'email'=>'required|email|unique:users',
            'password'=>'required|between:4,10|confirmed|alphanum',
            'password_confirmation'=>'required|between:4,10'
        );
        return Validator::make($input, $rules);
    }
}
