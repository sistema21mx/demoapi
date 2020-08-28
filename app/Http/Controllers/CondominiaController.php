<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Condominia;
use App\Owner;
use App\CondominiaType;
use App\Tenant;
use DB;

class CondominiaController extends Controller
{
    //
    public function list(Request $request)
    {
        $condominia = Condominia::all();
        /*
        $condominia = DB::table('condominias')
        ->select('condominias.id','condominias.code','condominias.owner','condominias.active','condominias.type',
        'condominia_types.description','condominia_types.cooperation')
        ->join('condominia_types', 'condominia_types.id', '=', 'condominias.type')
        ->get();
        */
        /*
        foreach($budget as $row){
            $row->netAmt = number_format(($row->netAmt),2);
            $row->closedStat = $row->closed === '1' ? true : false;
        }; */
        $ownerName = null;
        $tenantName = null;
        $type = null;
        $cooperation = null;
        foreach($condominia as $row){
            $ownerName = null;
            $tenantName = null;
            $type = null;
            $cooperation = 0;
            $owner = Owner::find($row->owner_id);
            $tenant = Tenant::find($row->tenant_id);
            $condominiaType = CondominiaType::find($row->type);
            if($owner){
                $ownerName = $owner->name;
            };
            if($tenant){
                $tenantName = $tenant->name;
            };
            if($condominiaType){
                $type = $condominiaType->description;
                $cooperation = $condominiaType->cooperation;
            };
            $row->ownerName = $ownerName;
            $row->tenantName = $tenantName;
            $row->description = $type;
            $row->cooperation = number_format(($cooperation),2);
            // $row->closedStat = $row->closed === '1' ? true : false;
        };
        $response = array();
        $response['loadData'] = 1;
        $response['error'] = 0;
        $response['message'] = '';
        $response['data'] = $condominia;
        return $response;
    }
    public function update(Request $request)
    {
        //
        $message = '';
        $error = 0;
        $formData = $request->all();
        $condominia = Condominia::find($request->id);
        if(!$condominia){
            $error = 1;
            $message = 'Registro no se encuentra';
        } else {
            //
            unset($formData['id']);
            $formData['code'] = str_replace(" ","",$formData['code']);
            $condominia->fill($formData)->save();
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
        $condominia = new Condominia();
        $formData['code'] = str_replace(" ","",$formData['code']);
        $condominia->fill($formData)->save();
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
        $condominia = Condominia::where('active', '1')->get();
        $data = array();
        $type = null;
        $ownerName = null;
        foreach($condominia as $row){
            $type = null;
            $ownerName = null;
            $condominiaType = CondominiaType::find($row->type);
            $owner = Owner::find($row->owner_id);
            if($condominiaType){
                $type = $condominiaType->description;
            };
            if($owner){
                $ownerName = $owner->name;
            };
            $data[] = [
                'opt' => $row->code . ' ' . $row->owner . ' ' . $type . ' ' . $ownerName,
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
    public function ids2(Request $request)
    {
        //
        $condominia = Condominia::where('active', '1')->get();
        $data = array();
        $type = null;
        // $ownerName = null;
        foreach($condominia as $row){
            $type = null;
            // $ownerName = null;
            $condominiaType = CondominiaType::find($row->type);
            // $owner = Owner::find($row->owner_id);
            $tenant = Tenant::find($row->tenant_id);
            if($condominiaType){
                $type = $condominiaType->description;
            };
            // if($owner){
            //     $ownerName = $owner->name;
            // };
            if($tenant){
                $tenantName = $tenant->name . ' ' . $tenant->movil;
            };
            $data[] = [
                'opt' => $row->code . ' ' . ' ' . $type . ' ' . $tenantName,
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
