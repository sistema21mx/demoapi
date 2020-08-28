<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

// use App\Item;

// class Customer extends Model
class Customer extends Authenticatable implements JWTSubject
{
    //
    use Notifiable;
	protected $table = 'customers';
	protected $primaryKey = 'id';
	protected  $fillable = [
		'name', 'customerCode', 'rfc', 'movil', 
		'user_id', 'active', 'email', 'artrm_id',
		'address', 'colony', 'town', 'city', 'zipCode'
	];

	protected  $hidden = [
		'created_at', 'updated_at'
	];

	protected  $casts = [
		// 'email_verified_at' => 'datetime',
	];

	public function itemsAnt()
	{
		//
		return $this->hasMany(Item::class);
	}

	public function items()
	{
		//
		return $this->belongsToMany(Item::class);
	}

	public  function  getJWTIdentifier() {
		return  $this->getKey();
	}

	public  function  getJWTCustomClaims() {
		return [];
	}
}
