<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Controlpermission;

// class SharedController extends Controller
trait SharedController
{
    public $permission = ['readonly' => '1', 'suspended' => '0'];
    public $loadData = 1;
    public $error = 0;
    public $message = null;
    public $data = Array();
    public function permission(Request $request)
    {
        $controlpermission = ControlPermission::first();
        if($controlpermission){
            if($controlpermission->suspended==='1'){
                $this->error = 1;
                $this->message = 'Aviso. No se pudo procesar información, Contacte con su Administrador';
            };
            if($controlpermission->readonly==='1'){
                $this->error = 1;
                $this->message = 'Aviso. No se pudo actualizar información, Contacte con su Administrador';
            };
        };
        return $controlpermission;        
    }
}
