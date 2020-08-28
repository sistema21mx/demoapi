<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Profile;
use App\Menutype;
use App\Menu;
use DB;

class ProfileController extends Controller
{
    //
    public function profile($id, Request $request){
        $module = Menutype::where('active', '1')
        ->orderBy('id', 'ASC')
        ->get(); 
        $modules = []; $menus = [];
        
        foreach($module as $itemModule){
            //
            $menus = [];
            $profile = DB::table('profiles')
            ->select('profiles.id','profiles.usr_id','profiles.mnu_id','profiles.active',
            'menus.type', 'menus.label', 'menus.link', 'menus.icon','menus.description')
            ->join('menus', 'menus.id', '=', 'profiles.mnu_id')
            ->where('menus.type', '=', $itemModule->id)
            ->where('menus.active', '1')
            ->where('profiles.active', '1')
            ->where('profiles.usr_id', $id)
            ->orderBy('menus.orderlist','ASC')
            ->get();
            foreach($profile as $itemProfile){
                //
                $menus[] = [ 
                    'mnu_type' => $itemProfile->type, 
                    'title' => $itemProfile->label,
                    'link' => $itemProfile->link,
                    'icon' => $itemProfile->icon,
                    'description' => $itemProfile->description
                ];
            };
            if(count($menus)===0) continue;
            $modules[] = [
                'id' => $itemModule->id,
                'title' => $itemModule->description,
                'action' => $itemModule->icon,
                'items' => $menus
            ];
        };
        /*
        foreach($module as $itemModule){
            $menus = [];
            $profile = Profile::all()
            ->where('active', '1')
            ->where('usr_id', $id);
            foreach($profile as $itemProfile){
                // $tipo = Menu::findOrFail($itemProfile->mnu_id);
                $tipo = Menu::find($itemProfile->mnu_id);
                if(!$tipo) continue;
                if($tipo->active === '0') continue;
                if(intval($tipo->type) !== intval($itemModule->id)) continue;
                $menus[] = [ 
                    'mnu_type' => $tipo->type, 
                    'title' => $tipo->label,
                    'link' => $tipo->link,
                    'icon' => $tipo->icon,
                    'description' => $tipo->description
                ];
            }
            if(count($menus)===0) continue;
            $modules[] = [
                'id' => $itemModule->id,
                'title' => $itemModule->description,
                'action' => $itemModule->icon,
                'items' => $menus
            ];
        }
        */
        // return $modules;
        $response = array();
        $response['loadData'] = 1;
        $response['error'] = 0;
        $response['message'] = '';
        $response['data'] = $modules;
        return $response;
    }

    public function profilUser( Request $request){
        $userId = $request->userId;
        $data = Profile::where('active', '1')
        ->where('usr_id', $userId)
        ->get();
        $options = [];
        $i = 0;
        foreach($data as $itemOption){
            $options[$i] = strval($itemOption->mnu_id) ;
            $i++;
        }
        $response = array();
        $response['loadData'] = 1;
        $response['error'] = 0;
        $response['message'] = '';
        $response['data'] = $options;
        return $response;

    }

    public function profilSave( Request $request){
        $userId = $request->userId;
        $checkedOptions = $request->checkedOptions;
        $data = Profile::where('usr_id', $userId)
        ->update(['active' => '0']);
        foreach($checkedOptions as $itemOption){
            $createData = Profile::firstOrCreate([
                'usr_id' => $userId,
                'mnu_id' => intval($itemOption)
            ]);
            $createData->active = '1';
            $createData->save();

        }
        $message = 'Aviso. Se guardaron los cambios.';

        $response = array();
        $response['loadData'] = 1;
        $response['error'] = 0;
        $response['message'] = $message;
        $response['data'] = $checkedOptions;
        return $response;

    }

}
