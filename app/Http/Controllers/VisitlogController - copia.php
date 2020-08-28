<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Visitlog;
use App\Condominia;

class VisitlogController extends Controller
{
    //
    public function list(Request $request)
    {
        //
        $visitlog = Visitlog::all();
        $data = [];
        foreach ($visitlog as $row){
            $datein = null;
            $hhin = 0;
            $mmin = 0;
            $ssin = 0;
            $hhout = 0;
            $mmout = 0;
            $ssout = 0;
            $dateout = null;
            $condominia = null;
            // $datein = strtotime($row->datein); 
            $condominia = Condominia::find($row->condominia_id);
            if($condominia){
                $condominia = $condominia->code;
            };
            if($row->datein!==null){
                $datein = date('h:i A', strtotime($row->datein));
                $hhin = date('H', strtotime($row->datein));
                $mmin = date('i', strtotime($row->datein));
                $ssin = date('s', strtotime($row->datein));
            };
            if($row->dateout!==null){
                $dateout = date('h:i A', strtotime($row->dateout));
                $hhout = date('H', strtotime($row->dateout));
                $mmout = date('i', strtotime($row->dateout));
                $ssout = date('s', strtotime($row->dateout));
            };

            $data[] = [ 
                'id' => $row->id, 
                'datedoc' => $row->datedoc, 
                'name' => $row->name, 
                'condominia_id' => $row->condominia_id, 
                'condominia' => $condominia,
                'datein' => $datein, 
                'isoIn' => $row->datein, 
                'hhin' => $hhin,
                'mmin' => $mmin,
                'ssin' => $ssin,
                'dateout' => $dateout,
                'isoOut' => $row->dateout, 
                'hhout' => $hhout,
                'mmout' => $mmout,
                'ssout' => $ssout,
                'reference' => $row->reference, 
                // 'names' => ($row->firstname . ' ' . $row->midname . ' ' . $row->lastname), 
                // 'movil' => $row->movil, 
                // 'password' => '', 
                // 'active' => ($row->active === '1' ? 'Si' : 'No') // $row->usr_activo 
            ];
        };


        $response = array();
        $response['loadData'] = 1;
        $response['error'] = 0;
        $response['message'] = '';
        $response['data'] = $data;
        return $response;
    }
    public function update(Request $request)
    {
        //
        $message = '';
        $error = 0;
        $formData = $request->all();
        $visitlog = Visitlog::find($request->id);
        if(!$visitlog){
            $error = 1;
            $message = 'Registro no se encuentra';
        } else {
            //
            unset($formData['id']);
            // $visitlog->fill($formData)->save();
            $visitlog->datein = $formData['isoIn'];
            $visitlog->dateout = $formData['isoOut'];
            $visitlog->save();
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
        $visitlog = new Visitlog();
        // $visitlog->fill($formData)->save();
        $visitlog->datein = $formData['isoIn'];
        
        $error = 0;
        $message = 'Nuevo Registro creado.';
        $visitlog->save();
        $response = array();
        $response['loadData'] = 1;
        $response['error'] = $error;
        $response['message'] = $message;
        if(isset($column)){ $response['column'] = $column; };
        $response['data'] = [$formData];
        return $response;
    }
}
