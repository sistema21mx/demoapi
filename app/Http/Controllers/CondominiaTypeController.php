<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\CondominiaType;

class CondominiaTypeController extends Controller
{
    //
    public function list(Request $request)
    {
        $condominiaType = CondominiaType::all();
        /*
        foreach($xbxudget as $row){
            $row->netAmt = number_format(($row->netAmt),2);
            $row->closedStat = $row->closed === '1' ? true : false;
        }; */
        foreach($condominiaType as $row){
            $row->cooperation = number_format(($row->cooperation),2);
        };
        $response = array();
        $response['loadData'] = 1;
        $response['error'] = 0;
        $response['message'] = '';
        $response['data'] = $condominiaType;
        return $response;
    }
    public function update(Request $request)
    {
        //
        $message = '';
        $error = 0;
        $formData = $request->all();
        $condominiaType = CondominiaType::find($request->id);
        if(!$condominiaType){
            $error = 1;
            $message = 'Registro no se encuentra';
        } else {
            //
            unset($formData['id']);
            $formData['code'] = str_replace(" ","",$formData['code']);
            $formData['cooperation'] = preg_replace("/([^0-9\\.\\-])/i", "", $formData['cooperation']);
            $condominiaType->fill($formData)->save();
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
        $condominiaType = new CondominiaType();
        $formData['code'] = str_replace(" ","",$formData['code']);
        $formData['cooperation'] = preg_replace("/([^0-9\\.\\-])/i", "", $formData['cooperation']);
        $condominiaType->fill($formData)->save();
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
        $condominiaType = CondominiaType::where('active', '1')->get();
        $data = array();
        foreach($condominiaType as $row){
            $data[] = [
                'opt' => $row->code . ' ' . $row->description,
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
