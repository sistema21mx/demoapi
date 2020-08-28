<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

// class Menu extends Model
class Menu extends Model implements JWTSubject

{
    //
    use Notifiable;

	protected $table = 'menus';
	protected $primaryKey = 'id';
	protected $fillable = 
	['type','orderlist','label','link',
	 'description','icon','active'];
    protected $hidden = [
        'created_at','updated_at'
	];

	public function menuType()
	{
		return $this->belongsTo(Menutype::class, 'type', 'id');
	}

	public  function  getJWTIdentifier() {
		return  $this->getKey();
	}

	public  function  getJWTCustomClaims() {
		return [];
	}
}
