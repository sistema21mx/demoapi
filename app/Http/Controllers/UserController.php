<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class UserController extends Controller
{
    //
    public function userAll(){
        $users = User::all();
        return $users;
    }

    public function userGet($id){
        $user = User::find($id);
        // $user->error = 0;
        return $user;
    }

    public function userAdd(Request $request){
        $users = User::create($request->all());
        return $users;
    }

    public function get($id){
        $user = User::find($id);
        return $user;
    }

    public function userEdit($id, Request $request){
        $user = $this->get($id);
        $user->fill($request->all())->save();
        return $user;
    }

    public function userDel($id){
        $message = 'deleting';
        $error = 1;
        $data = [];
        $user = $this->get($id);
        if(!$user){
            $error = 1;
            $message = 'Registro no se encuentra';
        } else {
            $data = $user;
            // $user->delete();
            $error = 0;
            $message = 'Registro se elimino';
        }
        $response = array();
        $response['error'] = $error;
        $response['message'] = $message;
        $response['data'] = $data;
        return $response;
    }

    public function userList(Request $request)
    {
        //
        $data = User::all();
        $users = [];
        foreach ($data as $itemUser){
            $users[] = [ 
                'id' => $itemUser->id, 
                'email' => $itemUser->email, 
                'firstname' => $itemUser->firstname, 
                'midname' => $itemUser->midname, 
                'lastname' => $itemUser->lastname, 
                'names' => ($itemUser->firstname . ' ' . $itemUser->midname . ' ' . $itemUser->lastname), 
                'movil' => $itemUser->movil, 
                'password' => '', 
                'active' => ($itemUser->active === '1' ? 'Si' : 'No') // $itemUser->usr_activo 
            ];
        };
        $response = array();
        $response['loadData'] = 1;
        $response['error'] = 0;
        $response['message'] = '';
        $response['data'] = $users;
        return $response;
    }

    public function userUpdate(Request $request)
    {
        $message = '';
        $error = 0;
        $formData = $request->all();
        $password = $formData['password'];
        // ->only(['sysname'])
        unset($formData['id']);
        unset($formData['names']);
        unset($formData['password']);
        // $sysname = explode('0',$formData['email'],0);
        // $sysname = explode('@', $formData['email'])[0];
        $repeatedUser = User::where('email', $request->email)
          ->where('id', '<>', $request->id)
          ->get()
          ->count();
          if($repeatedUser===1){
            $error = 1;
            $message = 'Email de Usuario ya existe, No es posible guardar.';
            $column = 'text_email';
        } else {
            $user = User::find($request->id);
            if(!$user){
                $error = 1;
                $message = 'Registro no se encuentra';
            } else {
                //
                $formData['sysname'] = explode('@', $formData['email'])[0];
                $formData['active'] = ($formData['active'] === 'Si' ? '1' : '0');
                if($password!==NULL){
                    $formData['password'] = password_hash($password, PASSWORD_DEFAULT);
                }
                $user->fill($formData)->save();
                $error = 0;
                $message = 'Registro actualizado.';
            }
        }
        $response = array();
        $response['loadData'] = 1;
        $response['error'] = $error;
        $response['message'] = $message;
        if(isset($column)){ $response['column'] = $column; };
        $response['data'] = [$formData];
        // $response['sysname'] = [$sysname];
        return $response;
    }

    public function setPass(Request $request)
    {
        $message = '';
        $error = 0;
        $formData = $request->all();
        $user = User::find($request->id);
        if(!$user){
            $error = 1;
            $message = 'Error. Usuario no se encuentra';
        } else {
            //
            $message = 'Aviso. Usuario se encuentra';
            if (!password_verify($request->oldPass, $user->password)){
                $error = 1;
                $message = 'Aviso. Contraseña actual no coincide';
            } else {
                $error = 0;
                $message = 'Aviso. Contraseña actual aceptada';
                $formData['newPass'] = password_hash($request->newPass, PASSWORD_DEFAULT);
                $user->password = $formData['newPass'];
                $user->save();
                $message = 'Aviso. Contraseña fue actualizada';
                // $formData['confPass'] = null;
            };
        };
        $response = array();
        $response['loadData'] = 1;
        $response['error'] = $error;
        $response['message'] = $message;
        if(isset($column)){ $response['column'] = $column; };
        $response['data'] = null;
        // $response['sysname'] = [$sysname];
        return $response;
    }

    public function userCreate(Request $request)
    {
        //
        $message = '';
        $error = 0;
        $formData = $request->all();
        $password = $formData['password'];
        // ->only(['sysname'])
        // unset($formData['id']);
        unset($formData['names']);
        // unset($formData['password']);

        $repeatedUser = User::where('email', $request->email)
          ->where('id', '<>', $request->id)
          ->get()
          ->count();
          if($repeatedUser===1){
            $error = 1;
            $message = 'Email de Usuario ya existe, No es posible guardar.';
            $column = 'text_email';
        } else {
        //
        // 
            // $pass = $param['contrasena'];

            $user = new User();
            unset($formData['id']);
            $formData['sysname'] = explode('@', $formData['email'])[0];
            $formData['active'] = ($formData['active'] === 'Si' ? '1' : '0');
            if($password!==NULL){
                $formData['password'] = password_hash($password, PASSWORD_DEFAULT);
            }

            // $user->fill($formData);
            $user->fill($formData)->save();
            // $user->fill($formData)->save();

            $error = 0;
            $message = 'Nuevo Registro creado.';
        }

      $response = array();
      $response['loadData'] = 1;
      $response['error'] = $error;
      $response['message'] = $message;
      if(isset($column)){ $response['column'] = $column; };
      $response['data'] = [$formData];
      return $response;

    }
    public function userPassId(Request $request){
        $message = '';
        $error = 0;
        $formData = $request->all();
        $user = User::find($request->id);
        if(!$user){
            $error = 1;
            $message = 'Error. Usuario no se encuentra';
        } else {
            $message = 'Aviso. Usuario se encuentra';
            $formData['newPass'] = password_hash($request->newPass, PASSWORD_DEFAULT);
            $user->password = $formData['newPass'];
            $user->save();
            $message = 'Aviso. Contraseña fue actualizada';
        };
        $response = array();
        $response['loadData'] = 1;
        $response['error'] = $error;
        $response['message'] = $message;
        if(isset($column)){ $response['column'] = $column; };
        $response['data'] = null;
        return $response;
    }

}
