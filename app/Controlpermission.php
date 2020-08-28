<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Controlpermission extends Authenticatable implements JWTSubject
// class Controlpermission extends Model
{
    //
    use Notifiable;
	protected $table = 'controlpermissions';
	protected $primaryKey = 'id';
	protected  $fillable = [
		'readonly', 'suspended'
	];

	protected  $hidden = [
		'id', 'created_at', 'updated_at'
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
