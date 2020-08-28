<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Expense;
use DB;
//
use App\Budget;
use App\Provider;

class ExpenseController extends Controller
{
    //
    public function list(Request $request)
    {
        //
        $expense = Expense::all();
        /*
        $expense = DB::table('expenses')
        ->select('expenses.id','expenses.datedoc','expenses.description','expenses.referenceapp','expenses.provider_id',
        'expenses.budget_id','expenses.amount','expenses.amountapp','expenses.active','expenses.user_id','budgets.name','providers.code')
        ->join('budgets', 'budgets.id', '=', 'expenses.budget_id')
        ->join('providers', 'providers.id', '=', 'expenses.provider_id')
        ->orderBy('datedoc','DESC')
        ->get();
        */
        foreach($expense as $row){
            // $row->closedStat = $row->closed === '1' ? true : false;
            if($row->active==='1'){
                $row->status = 
                $row->amount <> $row->amountapp ? 'Pendiente Pago' : 'Pagado ' . $row->referenceapp;
            } else {
                $row->status = 'Cancelada';
            };
            $row->amount = number_format(($row->amount),2);

        };
        $response = array();
        $response['loadData'] = 1;
        $response['error'] = 0;
        $response['message'] = '';
        $response['data'] = $expense;
        return $response;
    }
    public function update(Request $request)
    {
        //
        $message = '';
        $error = 0;
        $formData = $request->all();
        $expense = Expense::find($request->id);
        if(!$expense){
            $error = 1;
            $message = 'Registro no se encuentra';
        } else {
            //
            unset($formData['id']);
            $formData['amount'] = preg_replace("/([^0-9\\.\\-])/i", "", $formData['amount']);
            $expense->fill($formData)->save();
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
        $expense = new Expense();
        $formData['amount'] = preg_replace("/([^0-9\\.\\-])/i", "", $formData['amount']);
        $expense->fill($formData)->save();
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
    public function updata(Request $request)
    {
        //
        $formData = $request->all();
        $lineas = 1;
        $conlin = 0;
        $data = array();
        $message = '';
        foreach($formData as $row){
            // $row->closedStat = $row->closed === '1' ? true : false;
            $conlin += 1;
            if($conlin>$lineas) continue;
            $data[] = 
                $row
            ;
            // $budget = Budget::find($request->id);
            // $message = 'buscando ' . $conlin . ' ' . $row['presupuesto'];
            // $budget = Budget::where('code', $row['presupuesto'])->get();
            $budget = Budget::where('code', '=', $row['presupuesto'])->first();
            if(!$budget){
                // $error = 0;
                $message = 'Registro no se encuentra';
                $budget = new Budget();
                $budget->code = $row['presupuesto'];
                $budget->year = 2020;
                $budget->save();
            } else {
                //
                // $message = 'Registro se encuentra';
            };
            $provider = Provider::where('code', '=', $row['rfc'])->first();
            if(!$provider){
                //
                $message = 'Registro no se encuentra';
                $provider = new Provider();
                $provider->code = $row['rfc'];
                $provider->description = $row['proveedor'];
                $provider->save();
            } else {
                //
                // $message = 'Registro se encuentra';
            };
            $expense = new Expense();
            $row['proveedor'] = preg_replace("/([^0-9\\.\\-])/i", "", $row['proveedor']);
            $expense->description = $row['concepto'];
            $expense->save();

    


        };
        $response = array();
        $response['loadData'] = 1;
        $response['error'] = 0;
        $response['message'] = $message;
        $response['data'] = $data;
        return $response;
    }
}
