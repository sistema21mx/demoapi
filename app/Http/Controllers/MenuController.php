<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Menu;
use App\Menutype;

class MenuController extends Controller
{
    //
    public function menuProfile(Request $request)
    {
        $data = Menu::where('active', '1')
        ->orderBy('type', 'ASC')->orderBy('orderlist', 'ASC')->get();
        $options = [];
        foreach($data as $itemOption){
            $options[] = [
                'opcId' => strval($itemOption->id),
                'etiqueta' => $itemOption->label
            ];
        }
        $response = array();
        $response['loadData'] = 1;
        $response['error'] = 0;
        $response['message'] = '';
        $response['data'] = $options;
        return $response;  
    }

    public function menuType(Request $request)
    {
        $menu = Menu::find(5);
        $type = $menu->menuType;
        $response = array();
        $response['loadData'] = 1;
        $response['error'] = 0;
        $response['message'] = '';
        $response['data'] = $menu;
        return $response; 
    }

    public function menuTypeList(Request $request)
    {
        // $data = Menutype::find(3);
        // $menus = $data->menu;
        $menutypes = MenuType::all();
        foreach($menutypes as $menutype){
            $menus = Menu::all()
            ->where('type', $menutype->id);
            foreach($menus as $menu){
                $data[] = [
                    'type' => $menutype->id,
                    'desctype' => $menutype->description,
                    'id' => $menu->id,
                    'orderlist' => $menu->orderlist,
                    'label' => $menu->label,
                    'link' => $menu->link,
                    'description' => $menu->description,
                    'icon' => $menu->icon,
                    'active' => ($menu->active === '1' ? 'Si' : 'No') 
                ];
            };
        }
        $response = array();
        $response['loadData'] = 1;
        $response['error'] = 0;
        $response['message'] = '';
        $response['data'] = $data;
        return $response; 
    }

    public function menUpdate(Request $request)
    {
        //
        $message = '';
        $error = 0;
        $formData = $request->all();
        unset($formData['id']);
        unset($formData['orderlist']);
        unset($formData['desctype']);
        $repeatedVal = Menu::where('link', $request->link)
          ->where('id', '<>', $request->id)
          ->get()
          ->count();
        if($repeatedVal===1){
            $error = 1;
            $message = 'Campo Link ya existe, No es posible guardar.';
            $column = 'text_link';
        } else {

            $menu = Menu::find($request->id);
            if(!$menu){
                $error = 1;
                $message = 'Registro no se encuentra';
            } else {
                $formData['active'] = ($formData['active'] === 'Si' ? '1' : '0');
                $menu->fill($formData)->save();
                $error = 0;
                $message = 'Aviso: Registro actualizado.';
            }
        }

        $response = array();
        $response['loadData'] = 1;
        $response['error'] = $error;
        $response['message'] = $message;
        if(isset($column)){ $response['column'] = $column; };
        $response['data'] = $formData;
        return $response; 
    }

    public function menuCreate(Request $request)
    {
        //
        $message = '';
        $error = 0;
        $formData = $request->all();
        unset($formData['id']);
        unset($formData['orderlist']);
        unset($formData['desctype']);
        $repeatedVal = Menu::where('link', $request->link)
          ->where('id', '<>', $request->id)
          ->get()
          ->count();
        if($repeatedVal===1){
            $error = 1;
            $message = 'Campo Link ya existe, No es posible guardar.';
            $column = 'text_link';
        } else {
            $menu = new Menu();
            $formData['active'] = ($formData['active'] === 'Si' ? '1' : '0');
            $menu->fill($formData)->save();
            $error = 0;
            $message = 'Nuevo Registro creado.';

        }
        $response = array();
        $response['loadData'] = 1;
        $response['error'] = $error;
        $response['message'] = $message;
        if(isset($column)){ $response['column'] = $column; };
        $response['data'] = $formData;
        return $response;

    }

}
