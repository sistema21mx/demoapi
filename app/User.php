<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

// class User extends Model
class User extends Authenticatable implements JWTSubject
{
    //
    use Notifiable;
	protected $table = 'users';
	protected $primaryKey = 'id';
	protected  $fillable = [
		'sysname', 'firstname', 'midname', 'lastname', 
		'active', 'movil','email', 'password', 'user_id'
	];

	protected  $hidden = [
		'password', 
		'remember_token',
		'created_at', 'updated_at'
	];

	protected  $casts = [
		// 'email_verified_at' => 'datetime',
	];

	public  function  getJWTIdentifier() {
		return  $this->getKey();
	}

	public  function  getJWTCustomClaims() {
		return [];
	}    
}
