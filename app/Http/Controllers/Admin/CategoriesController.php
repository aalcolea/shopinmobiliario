<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request, Validator, Str;
use App\Http\Models\Category;


class CategoriesController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('user.status');
        $this->middleware('isadmin');
    }
    public function getHome($module){
        $cats = Category::where('module', $module)->orderBy('name', 'Asc')->get();
        $data = ['cats' => $cats];
        return view('admin.categories.home', $data);
    }
    public function postCategoryAdd(Request $request){
        $rules = [
            'name' => 'required',
            'icon' => 'required'
        ];
        $messages = [
            'name.required' => 'Nombre para categoria',
            'icon.required' => 'Icono para categoria'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Se ha producdio un error')->with('typealert', 'danger');
        else: 
            $c = new Category;
            $c->module = $request->input('module');
            $c->name = e($request->input('name'));
            $c->slug = Str::slug($request->input('name'));
            $c->icono = e($request->input('icon'));
            if($c->save()):
                return back()->with('message', 'Guardado exitoso')->with('typealert', 'success');
            endif;
        endif;
    }
    public function getCategoryEdit($id){
        $cat = Category::find($id);
        $data = ['cat' => $cat];
        return view('admin.categories.edit', $data);
    }
    public function postCategoryEdit(Request $request, $id){
        $rules = [
            'name' => 'required',
            'icon' => 'required'
        ];
        $messages = [
            'name.required' => 'Nombre para categoria',
            'icon.required' => 'Icono para categoria'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Se ha producdio un error')->with('typealert', 'danger');
        else: 
            $c = Category::find($id);
            $c->module = $request->input('module');
            $c->name = e($request->input('name'));
            $c->icono = e($request->input('icon'));
            if($c->save()):
                return back()->with('message', 'Guardado exitoso')->with('typealert', 'success');
            endif;
        endif;
    }
    public function getCategoryDelete($id){
        $c = Category::find($id);
        if($c->delete()):
            return back()->with('message', 'Eliminado con exito')->with('typealert','success');
        endif;    
    }
}
