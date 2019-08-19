<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Storage;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'interest','pay_status','level',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function getStorageInstance()
    {

        $username = strstr($this->email, '@', true);
            //  $username = preg_split('/ +/', $username);
       $path = trim($username).'/';
       $dir = storage_path('app/public/'.$username.'/');
       Storage::makeDirectory($username);
      return Storage::createLocalDriver(["root" => $dir]);
    }
}
