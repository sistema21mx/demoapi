<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Budget;
use DB;

class BudgetController extends Controller
{
    //
    public function list(Request $request)
    {
        //

        $budget = Budget::all();
        foreach($budget as $row){
            $purchases = 0;
            $row->netAmt = number_format(($row->netAmt),2);
            $row->closedStat = $row->closed === '1' ? true : false;
            $purchases = DB::table('expenses')
            ->where('expenses.budget_id', '=', ($row->id))
            ->where('expenses.active', '=', '1')
            ->sum('expenses.amount');
            $row->spend = number_format(($purchases),2);


        };
        $response = array();
        $response['loadData'] = 1;
        $response['error'] = 0;
        $response['message'] = '';
        $response['data'] = $budget;
        return $response;
    }
    public function update(Request $request)
    {
        //
        $message = '';
        $error = 0;
        $formData = $request->all();
        $budget = Budget::find($request->id);
        if(!$budget){
            $error = 1;
            $message = 'Registro no se encuentra';
        } else {
            //
            unset($formData['id']);
            $formData['code'] = str_replace(" ","",$formData['code']);
            $formData['netAmt'] = preg_replace("/([^0-9\\.\\-])/i", "", $formData['netAmt']);
            $budget->fill($formData)->save();
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
        $budget = new Budget();
        $formData['code'] = str_replace(" ","",$formData['code']);
        $formData['netAmt'] = preg_replace("/([^0-9\\.\\-])/i", "", $formData['netAmt']);
        $budget->fill($formData)->save();
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
    public function stat(Request $request)
    {
        //
        $message = '';
        $error = 0;
        $formData = $request->all();

        foreach($formData as $row){
            $budget = Budget::find($row['id']);
            if($budget){
                $budget->closed = $row['closedStat'] === true ? '1' : '0';
                $budget->save();    
            } else {
                $error = 1;
            };
        };
        if($error === 0){ $message = 'Aviso: Registro actualizado'; };
        $response = array();
        $response['loadData'] = 1;
        $response['error'] = $error;
        $response['message'] = $message;
        if(isset($column)){ $response['column'] = $column; };
        $response['data'] = [];
        return $response;
    }
    public function ids(Request $request)
    {
        //
        $budget = Budget::where('active', '1')->get();
        $data = array();
        foreach($budget as $row){
            $data[] = [
                'opt' => $row->code . ' ' . $row->name,
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

