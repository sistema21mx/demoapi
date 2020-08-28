<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Customer;
use App\Item;
use PDF;

class CustomerController extends Controller
{
    //
    public function hasMany(Request $request)
    {
        // hasMany onetomany
        $customer = Customer::find(1);
        $items = $customer->items;
        $response = array();
        $response['loadData'] = 1;
        $response['error'] = 0;
        $response['message'] = '';
        $response['data1'] = $customer;
        return $response;
    }

    public function ids(Request $request)
    {
        //
        $customer = Customer::where('active', '1')->get();
        $data = array();
        foreach($customer as $row){
            $data[] = [
                'opt' => $row->customerCode,
                'val' => $row->id,
                'artrm_id' => $row->artrm_id
            ];
        };
        $response = array();
        $response['loadData'] = 1;
        $response['error'] = 0;
        $response['message'] = '';
        $response['data'] = $data;
        return $response;        
    }
    public function list(Request $request)
    {
        //
        $customer = Customer::all();
        foreach($customer as $row){
            if($row->movil!==null){
                $row->movil =
                sprintf("%s-%s-%s",
                substr($row->movil, 0, 2),
                substr($row->movil, 2, 4),
                substr($row->movil, 6)
                );
            };
            $row->artrm_id = (int)$row->artrm_id;
        };
        foreach ($customer as $key => $value) { 
            $value->index = $key;
        };
        $response = array();
        $response['loadData'] = 1;
        $response['error'] = 0;
        $response['message'] = '';
        $response['data'] = $customer;
        return $response;
    }
    public function create(Request $request)
    {
        //
        $message = '';
        $error = 0;
        $formData = $request->all();
        unset($formData['id']);
        $customer = new Customer();
        // $formData['active'] = ($formData['active'] === 'Si' ? '1' : '0');
        // $formData['gender'] = 'M';
        if($formData['movil']!==null){
            $formData['movil'] = str_replace('-','',$formData['movil']);
        };
        $customer->fill($formData)->save();
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
    public function update(Request $request)
    {
        //
        $message = '';
        $error = 0;
        $formData = $request->all();
        $customer = Customer::find($request->id);
        if(!$customer){
            $error = 1;
            $message = 'Registro no se encuentra';
        } else {
            //
            unset($formData['id']);
            if($formData['movil']!==null){
              $formData['movil'] = str_replace('-','',$formData['movil']);
            };
            // $formData['active'] = ($formData['active'] === 'Si' ? '1' : '0');
            $customer->fill($formData)->save();
            $error = 0;
            $message = 'Registro actualizado.';
        }

        $response = array();
        $response['loadData'] = 1;
        $response['error'] = $error;
        $response['message'] = $message;
        if(isset($column)){ $response['column'] = $column; };
        $response['data'] = [$formData];
        // $response['sysname'] = [$sysname];
        return $response;

    }
    public function print(Request $request)
    {
        $formData = $request->all();
        $customer = Customer::all();
        $data = array();
        $data['detail'] = $customer;
        $pdf = PDF::loadView('pdf.'.$formData['nameBlade'], $data);
        $pdf->setPaper('letter','portrait'); // Landscape
        return $pdf->stream();
    }
    public function printRem(Request $request)
    {
        $customer = Customer::all();
        $data = array();
        $data['compania'] = 'A R G O';
        $data['calle'] = 'Calle Tenochtitlan No. 16 Int. 5';
        $data['colonia'] = 'San Pedro Xalostoc';
        $data['municipio'] = 'Ecatepec';
        $data['ciudad'] = 'Edo. de Mex.';
        $data['cp'] = '55310';
        $data['tel'] = '55-1541-3479';
        //
        $data['cteNombre'] = 'Idustrias unidas S. A. de C. V.';
        $data['cteCalle'] = 'Estaño No. 22';
        $data['cteColonia'] = 'Nuava Ezfurzo Nacinal';
        $data['cteMunicipio'] = 'Ecatepec';
        $data['cteCiudad'] = 'Edo. de Mex.';
        $data['cteCp'] = '55317';
        $data['cteTel'] = '55-1541-3400';
        //
        $data['docId'] = '54321';
        $data['fecha'] = '19 / Jul / 2020';
        $data['cantidad'] = 1;
        $data['descripcion'] = 'FLETE DE AGUA 10,000 LTS';
        // $data[''] = '';
        // $data[''] = '';
        //
        $data['loadData'] = 1;
        $data['titulo'] = 'Reporte de usuarios';
        $data['hora'] = '04:00 am';
        $data['usuario'] = 'Fernando Kardiel';
        $data['detail'] = $customer;
        $pdf = PDF::loadView('pdf.remi', $data);
        $pdf->setPaper('letter','portrait'); // Landscape
        return $pdf->stream();

    }
    public function printOld(Request $request)
    {
        //
        $customer = Customer::all();
        $data = array();
        $data['loadData'] = 1;
        $data['titulo'] = 'Reporte de usuarios';
        $data['fecha'] = '31 / Febrero / 2019';
        $data['hora'] = '04:00 am';
        $data['usuario'] = 'Fernando Kardiel';
        $data['users'] = $customer;
        
        // $pdf = PDF::loadView('pdf.users', ['users' => $customer]);
        $pdf = PDF::loadView('pdf.pdfview', $data);
        return $pdf->stream('print.pdf');
        // $view =  \View::make('pdf.users', ['users' => $customer])->render();
        // $pdf = \App::make('dompdf.wrapper');
        // $pdf->loadHtml($view);
        // return $pdf->stream("invoice.pdf",array("Attachment" => false));
        // $pdf = PDF::loadView('pdf.users', ['users' => $customer]);
        // $customPaper = array(0,0,567.00,283.80);
        // $pdf->setPaper($customPaper, 'landscape');
    }
    public function downPdf(Request $request)
    {
        //
        $customer = Customer::all();
        $view = View('pdf.users', ['users' => $customer]);
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view->render());
        return $pdf->download('List.pdf');
    }
    
}
