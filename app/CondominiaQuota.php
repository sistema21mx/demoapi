<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

//class CondominiaQuota extends Model
class CondominiaQuota extends Authenticatable implements JWTSubject
{
    //
    use Notifiable;
	protected $table = 'condominia_quotas';
	protected $primaryKey = 'id';
	protected  $fillable = [
		'condominia_id', 'year', 'period', 'type', 
        'description', 'amount',
		'datedoc', 'datedue',
		'fund_id', 'budget_incomes_id',
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
