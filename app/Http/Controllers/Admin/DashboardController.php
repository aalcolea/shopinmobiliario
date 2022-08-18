<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class DashboardController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('user.status');
        $this->middleware('isadmin');
    }
    public function getDashboard(){
        return view('admin.dashboard');
    }
    public function getTest(){
       \DB::statement("SET SQL_MODE=''"); //ni idea pero gracias
        $country_list = DB::table('country_state_city')->groupBy('country')->get(); //>groupBy('country')-

        return view('admin.test')->with('country_list', $country_list);
    }
    public  function fetch(Request $request){
        \DB::statement("SET SQL_MODE=''"); //ni idea pero gracias
        $select = $request->get('select');
        $value = $request->get('value');
        $dependent = $request->get('dependent');
        $data = DB::table('country_state_city')->where($select, $value)->groupBy($dependent)->get();
        $output = '<option >'.ucfirst($dependent).'</option>';
        foreach($data as $row){
            $output .= '<option value="'.$row->$dependent.'">'.$row->$dependent.'</option>';
        }
        echo $output;
    }
}
