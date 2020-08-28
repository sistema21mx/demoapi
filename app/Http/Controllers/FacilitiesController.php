<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Facilities;

class FacilitiesController extends Controller
{
    //
    public function list(Request $request)
    {
        //
        $facilities = Facilities::all();
        $response = array();
        $response['loadData'] = 1;
        $response['error'] = 0;
        $response['message'] = '';
        $response['data'] = $facilities;
        return $response;
    }
    public function update(Request $request)
    {
        //
        $message = '';
        $error = 0;
        $formData = $request->all();
        $facilities = Facilities::find($request->id);
        if(!$facilities){
            $error = 1;
            $message = 'Registro no se encuentra';
        } else {
            //
            unset($formData['id']);
            $facilities->fill($formData)->save();
            $error = 0;
            $message = 'Registro actualizado.';
        }
        $response = array();
        $response['loadData'] = 1;
        $response['error'] = $error;
        $response['message'] = $message;
        if(isset($column)){ $response['column'] = $column; };
        $response['data'] = [$formData];
        return $response;
    }
    public function create(Request $request)
    {
        //
        $message = '';
        $error = 0;
        $formData = $request->all();
        unset($formData['id']);
        $facilities = new Facilities();
        $facilities->fill($formData)->save();
        $error = 0;
        $message = 'Nuevo Registro creado.';

        $response = array();
        $response['loadData'] = 1;
        $response['error'] = $error;
        $response['message'] = $message;
        if(isset($column)){ $response['column'] = $column; };
        $response['data'] = [$formData];
        return $response;
    }
}
