<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request, Validator, Str, Config, Image, Auth;
use App\Http\Models\Asesor;
use App\User;
use Session;

class AsesoresController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('user.status');
        /*$this->middleware('isadmin');*/
    }
    public function getHome(){
        $id = Auth::id();
        $as = Asesor::where('vendedorId', $id)->where('status', '1')->orderBy('name', 'Asc')->get();
        $data = ['as' => $as];
        return view('admin.asesores.home', $data);
    }
    public function postAsesorAdd(Request $request){
         $rules = [
            'name' => 'required',
            'img' => 'required',
            'number' => 'required|max:10|min:10'
        ];
        $messages = [
            'name.required' => 'Nombre del asesor',
            'img.required' => 'Imagen de perfil',
            'number.required' => 'Numero',
            'number.max' => 'Maximo 10 en numero',
            'number.min' => 'Minimo 10 en numero'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()){
            return back()->withErrors($validator)->with('message', 'Se ha producdio un error')->with('typealert', 'danger')->withInput();
        }else {
            $path = '/'.date('Y-m-d'); //crea una carpeta para las imagens
            $fileExt = trim($request->file('img')->getClientOriginalExtension()); //obtiene la ext
            $upload_path = Config::get('filesystems.disks.uploads.root');//ruta final del archivo
            $name = Str::slug(str_replace($fileExt,'', $request->file('img')->getClientOriginalName()));
            $filename = 'a_'.rand(1,999).'-'.$name.'.'.$fileExt;
            $final_file = $upload_path.'/'.$path.'/'.$filename;
            $a = new Asesor();
            $id = Auth::id();
            $a->name = e($request->input('name'));
            $a->slug = Str::slug($request->input('name'));
            $a->number = e($request->input('number'));
            $a->email = e($request->input('email'));
            $a->image = $filename;
            $a->file_path = date('Y-m-d');
            $a->vendedorId = $id;
            $a->status = "1";
            if($a->save()){
                if($request->hasFile('img')){
                    $fl = $request->img->storeAs($path, $filename, 'uploads');
                    $img = Image::make($final_file);
                    $img->fit(256, 256, function($constraints){
                        $constraints->upsize();
                    });
                    $img->save($upload_path.'/'.$path.'/t_'.$filename);
                }
                return redirect('/admin/asesores')->with('message', 'Asesor agregado con exito al equipo')->with('typealert', 'success');
            }
        }
    }
    public function getAsesorEdit($id){
        $as = Asesor::findOrFail($id);
        $data = ['as' => $as];
        return view('admin.asesores.edit', $data);
    }
    public function postAsesorEdit(Request $request,$id){
         $rules = [
            'name' => 'required',
            'number' => 'required|max:10|min:10'
        ];
        $messages = [
            'name.required' => 'Nombre del asesor',
            'number.required' => 'Numero',
            'number.max' => 'Maximo 10 en numero',
            'number.min' => 'Minimo 10 en numero'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()){
            return back()->withErrors($validator)->with('message', 'Se ha producdio un error')->with('typealert', 'danger')->withInput();
        }else{
            $a = Asesor::find($id);
            $a->name = e($request->input('name'));
            $a->email = e($request->input('email'));
            $a->number = $request->input('number');
            if($a->save()){
                return back()->with('message', 'Actualizado exitoso')->with('typealert', 'success');
            }
        }

    }
    public function getAsesorDelete($id){
        $as = Asesor::findOrFail($id);
        $as->status = "0";
        if($as->save()){
            return back()->with('message', 'Asesor eliminado del equioi con exito')->with('typealert','success');
        }
    }
}
