<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Quota;

class QuotaController extends Controller
{
    //
    public function list(Request $request)
    {
        //
        $quota = Quota::all();
        foreach($quota as $row){
            $row->amount = number_format(($row->amount),2);
            // $row->closedStat = $row->closed === '1' ? true : false;
        };
        $response = array();
        $response['loadData'] = 1;
        $response['error'] = 0;
        $response['message'] = '';
        $response['data'] = $quota;
        return $response;
    }
    public function update(Request $request)
    {
        //
        $message = '';
        $error = 0;
        $formData = $request->all();
        $quota = Quota::find($request->id);
        if(!$quota){
            $error = 1;
            $message = 'Registro no se encuentra';
        } else {
            //
            unset($formData['id']);
            $formData['code'] = str_replace(" ","",$formData['code']);
            $formData['amount'] = preg_replace("/([^0-9\\.\\-])/i", "", $formData['amount']);
            $quota->fill($formData)->save();
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
        $quota = new Quota();
        $formData['code'] = str_replace(" ","",$formData['code']);
        $formData['amount'] = preg_replace("/([^0-9\\.\\-])/i", "", $formData['amount']);
        $quota->fill($formData)->save();
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
    
    public function findrow($id, Request $request){
        $formData = $request->all();
        $quota = Quota::where('code',$id)
        ->get();
        $response = array();
        $response['loadData'] = 1;
        $response['error'] = 0;
        $response['message'] = '';
        $response['data'] = $quota;
        return $response;
    }
    
}
