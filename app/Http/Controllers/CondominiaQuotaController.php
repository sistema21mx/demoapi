<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\CondominiaQuota;
use App\Condominia;

class CondominiaQuotaController extends Controller
{
    //
    public function list(Request $request)
    {
        //
        // $condominiaQuota = CondominiaQuota::all();
        $condominiaQuota = CondominiaQuota::orderByDesc('datedoc')->get();
        $owner = null;
        foreach($condominiaQuota as $row){
            $owner = null;
            if($row->active==='1'){
                $row->status = 
                $row->amount <> $row->amountapp ? 'Pendiente Pago' : 'Pagado ' . $row->referenceapp;
            } else {
                $row->status = 'Cancelada';
            };
            $condominia = Condominia::find($row['condominia_id']);
            if($condominia){
                $owner = $condominia['code'] . ' ' . $condominia['owner'];
            };
            $row->amount = number_format(($row->amount),2);
            $row->owner = $owner;

        };
        $response = array();
        $response['loadData'] = 1;
        $response['error'] = 0;
        $response['message'] = '';
        $response['data'] = $condominiaQuota;
        return $response;
    }
    public function create(Request $request)
    {
        //
        $message = '';
        $error = 0;
        $formData = $request->all();
        $rows = $formData['data'];
        unset($formData['data']);
        $count = 0;
        foreach($rows as $row){
            
            $condominiaQuota = new CondominiaQuota();
            $condominiaQuota->condominia_id = $row['id']; // $row['code'];
            $condominiaQuota->year = $formData['year'];
            $condominiaQuota->period = $formData['period'];
            $condominiaQuota->type = $formData['doctype'];;
            $condominiaQuota->description = $formData['description'];
            // $condominiaQuota->referenceapp = '';
            $condominiaQuota->amount = preg_replace("/([^0-9\\.\\-])/i", "", $row['cooperation']);
            // $condominiaQuota->amountapp = 0;
            $condominiaQuota->datedoc = $formData['datedoc'];
            $condominiaQuota->datedue = $formData['datedue'];
            $condominiaQuota->fund_id = $formData['fund_id'];
            $condominiaQuota->budget_incomes_id = $formData['budget_incomes_id'];
            $condominiaQuota->user_id = $formData['user_id'];
            $condominiaQuota->save();
            $count += 1;
            if($count === 1){
                // $condominiaQuota->save();
            };
        };
        $formData = $count;
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
    public function state(Request $request)
    {
        //
        $formData = $request->all();
        $condominiaQuota = [];
        $condominiaQuota = CondominiaQuota::orderByDesc('datedoc')->get();
        $state = [];
        foreach($condominiaQuota as $row){
            //
            if($row->active === '0') continue;
            if(intval($row->condominia_id) !== intval($formData['id'])) continue;
            $state[] = [
                'condominia_id' => $row->condominia_id,
                'datedoc' => $row->datedoc,
                'type' => $row->type,
                'concept' => $row->description,
                'charge' => number_format(($row->amount),2),
                'credit' => null,
                'status' => '-',
            ];
        };
        $response = array();
        $response['loadData'] = 1;
        $response['error'] = 0;
        $response['message'] = '';
        $response['data'] = $state;
        return $response;

    }

}
