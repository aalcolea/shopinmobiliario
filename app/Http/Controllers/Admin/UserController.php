<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('user.status');
        $this->middleware('isadmin');
    }
    public function getUsers($status){
        if($status == 'all'):
        $users = User::orderBy('id', 'Desc')->paginate(10);
    else: 
        $users = User::where('status', $status)->orderBy('id', 'Desc')->paginate(10);
    endif;
    $data = ['users'=> $users];
    return view('admin.users.home', $data);
    }
    public function getUserEdit($id){
        $u = User::findOrFail($id);
        $data = ['u' => $u];
        return view('admin.users.edit', $data);
    }
    public function getUserBanned($id){
        $u = User::findOrFail($id);
        if($u->status == "100"):
            $u->status = "1";
            $msg = 'Usuario ha sido reactivado';
        else:
            $u->status = "100";
            $msg = "Usuario suspendido con exito";
         endif;
         if($u->save()):
            return back()->with('message', $msg)->with('typealert', 'success');
        endif;    
    }
    public function getUserPermissons($id){
        $u = User::findOrFail($id);
        $data = ['u' => $u];
        return view('admin.users.permissons', $data);
    }
    public function postUserPermissons(Request $request, $id){
        $u = User::findOrFail($id);
        $permissons = [
            'dashboard' => $request->input('dashboard'),
            'categories' => $request->input('categories'),
            'products' => $request->input('products'),
            'product_add' => $request->input('product_add'),
            'product_edit' => $request->input('product_edit'),
            'product_delete' => $request->input('product_delete'),
            'user_list' => $request->input('user_list'),
            'user_edit' => $request->input('user_edit'),
            'user_banned' => $request->input('user_banned'),
            'user_delete' => $request->input('user_delete')
        ];
        $permissons = json_encode($permissons);
        $u->permissons = $permissons;
        if($u->save()):
            return back()->with('message', 'Permisos actualizados con exito')->with('typealert', 'success');
        endif;

    }
}
