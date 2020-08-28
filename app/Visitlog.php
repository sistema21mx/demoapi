<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

//class Visitlog extends Model
class Visitlog extends Authenticatable implements JWTSubject
{
    //
    use Notifiable;
	protected $table = 'visitlogs';
	protected $primaryKey = 'id';
	protected  $fillable = [
		'datedoc', 'datein', 'dateout', 'name', 'condominia_id', 'reference',
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
