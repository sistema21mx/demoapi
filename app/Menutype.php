<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

// class Menutype extends Model
class Menutype extends Model implements JWTSubject

{
    //
    use Notifiable;

	protected $table = 'menutypes';
	protected $primaryKey = 'id';
	protected $fillable = 
	['description','icon','active'];
	protected $hidden = ['created_at','updated_at'];
    
	public function menu(){
		return $this->hasMany(Menu::class, 'type', 'id')
		// ->where('mnu_activo', '1')
		->orderBy('orderlist');
	}

	public  function  getJWTIdentifier() {
		return  $this->getKey();
	}

	public  function  getJWTCustomClaims() {
		return [];
	}
}
