<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tenant;
// use App\Condominia;

class TenantController extends Controller
{
    //
    public function list(Request $request)
    {
        //
        $tenant = Tenant::all();
        // $condominia = null;
        foreach($tenant as $row){
            // $condominia = null;
            // $condominia = Condominia::find($row->condominia_id);
            // if($condominia){
            //     $condminia = $condominia->code;
            //     $row->code = $condminia;
            // };
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
        $response['data'] = $tenant;
        return $response;
    }
    public function update(Request $request)
    {
        //
        $message = '';
        $error = 0;
        $formData = $request->all();
        $tenant = Tenant::find($request->id);
        if(!$tenant){
            $error = 1;
            $message = 'Registro no se encuentra';
        } else {
            //
            unset($formData['id']);
            $formData['movil'] = str_replace("-","",$formData['movil']);
            $tenant->fill($formData)->save();
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
        $tenant = new Tenant();
        $formData['movil'] = str_replace("-","",$formData['movil']);
        $tenant->fill($formData)->save();
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
        $tenant = Tenant::where('active', '1')->get();
        $data = array();
        foreach($tenant as $row){
            $data[] = [
                'opt' => $row->code . ' ' . $row->name,
                'val' => $row->id
                // 'val' => strval($row->id)
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
