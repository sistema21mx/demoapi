<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

//class Bank extends Model
class Bank extends Authenticatable implements JWTSubject
{
    //
    use Notifiable;
	protected $table = 'banks';
	protected $primaryKey = 'id';
	protected  $fillable = [
		'name', 'branch', 'account', 'clabe', 'initialDay', 'initialBalance', 'fund_id',
		'active', 'user_id'
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
