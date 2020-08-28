<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

//class Deposit extends Model
class Deposit extends Authenticatable implements JWTSubject

{
    //
    use Notifiable;
	protected $table = 'deposits';
	protected $primaryKey = 'id';
	protected  $fillable = [
		'datedoc', 'reference', 'comment', 'amount', 'type', 'condominia_id', 'bank_id',
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
