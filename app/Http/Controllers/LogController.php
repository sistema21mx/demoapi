<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Log;
use PDF;

class LogController extends Controller
{
    //
    public function create(Request $request)
    {
        //
        $message = '';
        $error = 0;
        $formData = $request->all();
        unset($formData['id']);
        $log = new Log();
        // $formData['active'] = ($formData['active'] === 'Si' ? '1' : '0');
        // $formData['gender'] = 'M';
        // $formData['movil'] = str_replace('-','',$formData['movil']);
        $log->fill($formData)->save();
        $error = 0;
        $message = 'Logs created.';

        $response = array();
        $response['loadData'] = 1;
        $response['error'] = $error;
        $response['message'] = $message;
        $response['data'] = [$formData];
        return $response;
    }

}
