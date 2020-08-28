<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Deposit;
use App\Condominia;
use App\Bank;

class DepositController extends Controller
{
    //
    public function list(Request $request)
    {
        //
        $deposit = Deposit::all();
        $owner = null;
        $status = null;
        foreach($deposit as $row){
            $owner = null;
            $status = null;
            $condominia = Condominia::find($row['condominia_id']);
            if($condominia){
                $owner = $condominia['code'] . ' ' . $condominia['owner'];
            };
            if($row->active==='1'){
                $row->status = 'Pendiente Aplicar';
                // $row->amount <> $row->amountapp ? 'Pendiente Aplicar' : 'Aplicada ' . $row->referenceapp;
            } else {
                $row->status = 'Aplicada';
            };
            $row->amount = number_format(($row->amount),2);
            $row->owner = $owner;

            // $row->closedStat = $row->closed === '1' ? true : false;
        };
        $response = array();
        $response['loadData'] = 1;
        $response['error'] = 0;
        $response['message'] = '';
        $response['data'] = $deposit;
        return $response;
    }
    public function update(Request $request)
    {
        //
        $message = '';
        $error = 0;
        $formData = $request->all();
        $deposit = Deposit::find($request->id);
        if(!$deposit){
            $error = 1;
            $message = 'Registro no se encuentra';
        } else {
            //
            unset($formData['id']);
            $formData['amount'] = preg_replace("/([^0-9\\.\\-])/i", "", $formData['amount']);
            $deposit->fill($formData)->save();
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
        $deposit = new Deposit();
        $formData['amount'] = preg_replace("/([^0-9\\.\\-])/i", "", $formData['amount']);
        $deposit->fill($formData)->save();
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
        $deposit = [];
        $deposit = Deposit::orderByDesc('datedoc')->get();
        $state = [];
        foreach($deposit as $row){
            //
            if($row->active === '0') continue;
            if(intval($row->condominia_id) !== intval($formData['id'])) continue;
            $bankName = null;
            $bank = Bank::find($row->bank_id);
            if($bank){
                $bankName = $bank->name;
            };
            $state[] = [
                'condominia_id' => $row->condominia_id,
                'datedoc' => $row->datedoc,
                'type' => $row->type,
                'concept' => $bankName . ' Ref ' . $row->reference . ' ' . $row->comment,
                'charge' => null,
                'credit' => number_format(($row->amount),2),
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
