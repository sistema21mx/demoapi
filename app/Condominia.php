<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

//class Condominia extends Model
class Condominia extends Authenticatable implements JWTSubject
{
    //
    use Notifiable;
	protected $table = 'condominias';
	protected $primaryKey = 'id';
	protected  $fillable = [
		'code', 'type', 'owner_id', 'tenant_id', 'occupied', 'active', 
		'user_id'
	];
	protected  $hidden = [
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
