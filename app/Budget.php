<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

//class Budget extends Model
class Budget extends Authenticatable implements JWTSubject
{
    //
    use Notifiable;
	protected $table = 'budgets';
	protected $primaryKey = 'id';
	protected  $fillable = [
		'code', 'name', 'year', 'netAmt', 
		'active', 'closed', 'user_id'
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
