<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Provider;

class ProviderController extends Controller
{
    //
    public function list(Request $request)
    {
        //
        $provider = Provider::all();
        foreach($provider as $row){
            if($row->movil!==null){
                $row->movil =
                sprintf("%s-%s-%s",
                substr($row->movil, 0, 2),
                substr($row->movil, 2, 4),
                substr($row->movil, 6)
                );
            };
        };
        $response = array();
        $response['loadData'] = 1;
        $response['error'] = 0;
        $response['message'] = '';
        $response['data'] = $provider;
        return $response;
    }
    public function update(Request $request)
    {
        //
        $message = '';
        $error = 0;
        $formData = $request->all();
        $provider = Provider::find($request->id);
        if(!$provider){
            $error = 1;
            $message = 'Registro no se encuentra';
        } else {
            //
            unset($formData['id']);
            $formData['code'] = str_replace(" ","",$formData['code']);
            $provider->fill($formData)->save();
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
        $provider = new Provider();
        $formData['code'] = str_replace(" ","",$formData['code']);
        $provider->fill($formData)->save();
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
    public function ids(Request $request)
    {
        //
        $provider = Provider::where('active', '1')->get();
        $data = array();
        foreach($provider as $row){
            $data[] = [
                'opt' => $row->code . ' ' . $row->description,
                'val' => $row->id
            ];
        };
        $response = array();
        $response['loadData'] = 1;
        $response['error'] = 0;
        $response['message'] = '';
        $response['data'] = $data;
        return $response;        
    }
}
