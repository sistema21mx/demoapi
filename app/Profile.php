<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

// class Profile extends Model
class Profile extends Model implements JWTSubject

{
    //
    use Notifiable;

	protected $table = 'profiles';
	protected $primaryKey = 'id';
	protected $fillable = 
	['usr_id','mnu_id','active'];
    protected $hidden = [
        'created_at','updated_at'
    ];

	// revisar cambio de nombres en tablas, campos
	public function menu(){
		// return $this->hasOne('App\Menu', 'mnu_tipo', 'mnut_id');
		return $this->hasOne(Menu::class, 'mnu_id', 'perm_mnu_id')
		->where('mnu_activo', '1')
		->orderBy('mnu_orden');
	}

	public  function  getJWTIdentifier() {
		return  $this->getKey();
	}

	public  function  getJWTCustomClaims() {
		return [];
	}
}
