<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Vehicle;

class VehicleController extends Controller
{
    //
    public function list(Request $request)
    {
        //
        $vehicle = Vehicle::all();
        $response = array();
        $response['loadData'] = 1;
        $response['error'] = 0;
        $response['message'] = '';
        $response['data'] = $vehicle;
        return $response;
    }
    public function update(Request $request)
    {
        //
        $message = '';
        $error = 0;
        $formData = $request->all();
        $vehicle = Vehicle::find($request->id);
        if(!$vehicle){
            $error = 1;
            $message = 'Registro no se encuentra';
        } else {
            //
            unset($formData['id']);
            $vehicle->fill($formData)->save();
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
        $vehicle = new Vehicle();
        $vehicle->fill($formData)->save();
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
