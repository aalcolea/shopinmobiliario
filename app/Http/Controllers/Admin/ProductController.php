<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request, Validator, Str, Config, Image, Auth;
use App\Http\Models\Category;
use App\Http\Models\Asesor;
use App\Http\Models\Product;
use App\Http\Models\PGallery;
use App\User;
use Session;
use DB;

class ProductController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('user.status');
        /*$this->middleware('isadmin');*/
    }
    public function getHome(){
        $id = Auth::id();
        $products = Product::with(['cat'])->with(['ase'])->where('vendedorId', $id)->orderBy('id', 'desc')->paginate(25);
        $trash = Asesor::withTrashed()->get();
        $data = ['products' => $products, 'trash' => $trash];
        return view('admin.products.home', $data);
    }
    public function getProductAdd(){
        $id = Auth::id();
        $cats = Category::where('module', '0')->pluck('name', 'id'); //pluck convierte el llamado de JSON en un arreglo
        $as = Asesor::where('vendedorId', $id)->pluck('name', 'id');
        \DB::statement("SET SQL_MODE=''");
        $location = DB::table('location')->select('estado')->groupBy('estado')->get();
        $data  = ['cats' => $cats, 'as' => $as, 'location' => $location];
        return view('admin.products.add', $data);
    }
    public function getProductEdit($id){
        $cats = Category::where('module', '0')->pluck('name', 'id');
        $as = Asesor::where('vendedorId', $id)->pluck('name', 'id'); 
        $p = Product::findOrFail($id);
        $data  = ['cats' => $cats, 'p' => $p, 'as' => $as];
        return view('admin.products.edit', $data);
    }
    public function postProductAdd(Request $request){
        $rules = [
            'name' => 'required',
            'img' => 'required',
            'price' => 'required',
            'content' => 'required'
        ];
        $messages = [
            'name.required' => 'Nombre de producto obligatorio',
            'img.required' => 'Imagen del producto obligatoria',
            'img.image' => 'El tipo de archivo no es una imagen',
            'price.required' => 'Precio obligatorio',
            'content.required' => 'Por favor agregue una descripcion'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'danger')->withInput();
        else:
            $path = '/'.date('Y-m-d'); //crea una carpeta para las imagens
            $fileExt = trim($request->file('img')->getClientOriginalExtension()); //obtiene la ext
            $upload_path = Config::get('filesystems.disks.uploads.root');//ruta final del archivo
            $name = Str::slug(str_replace($fileExt,'', $request->file('img')->getClientOriginalName()));
            $filename = rand(1,999).'-'.$name.'.'.$fileExt;
            $final_file = $upload_path.'/'.$path.'/'.$filename;
            $product = new Product;
            $product->status = '0';
            $product->name = e($request->input('name'));
            $product->slug = Str::slug($request->input('slug'));
            $product->category_id = $request->input('category');
            $product->file_path = date('Y-m-d');
            $product->image = $filename;
            $product->price = $request->input('price');
            $product->in_discount = $request->input('indiscount');
            $product->discount = $request->input('discount');
            $product->content = e($request->input('content'));
            $idv = Auth::id();
            $product->asesor_id = $request->input('asesor');
            $product->vendedorid = $idv;
            $product->location = $request->input('estado');
            $product->sublocation = $request->input('ciudad');
            $product->sSublocation = $request->input('comisaria');
            if($product->save()):
                if($request->hasFile('img')): //consulta a la peticion si el archivo cuenta con una iamgen
                    $fl = $request->img->storeAs($path, $filename, 'uploads');
                    $img = Image::make($final_file);
                    $img->fit(256, 256, function($constraints){
                        $constraints->upsize();
                    });
                    $img->save($upload_path.'/'.$path.'/t_'.$filename);
                endif;
               /* $p->id = Product::findOrFail($id);*/
                return redirect('/admin/product')->with('message', 'Inmueble agregado con exito al sistema')->with('typealert', 'success'); ///'.$p->id.'/edit
            endif;
        endif;
    }
    public function postProductEdit($id, Request $request){
        $rules = [
            'name' => 'required',
            'price' => 'required',
            'content' => 'required'
        ];
        $messages = [
            'name.required' => 'Nombre de producto obligatorio',
            'price.required' => 'Precio obligatorio',
            'content.required' => 'Por favor agregue una descripcion'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'danger')->withInput();
        else:
            
            $product = Product::findOrFail($id);
            $imgPrevPath = $product->file_path;
            $imgPrev = $product->image;
            $product->status = e($request->input('status'));
            $product->name = e($request->input('name'));
            $product->category_id = $request->input('category');
            if($request->hasFile('img')):
                $path = '/'.date('Y-m-d'); //crea una carpeta para las imagens
                $fileExt = trim($request->file('img')->getClientOriginalExtension()); //obtiene la ext
                $upload_path = Config::get('filesystems.disks.uploads.root');//ruta final del archivo
                $name = Str::slug(str_replace($fileExt,'', $request->file('img')->getClientOriginalName()));
                $filename = rand(1,999).'-'.$name.'.'.$fileExt;
                $final_file = $upload_path.'/'.$path.'/'.$filename;
                $product->file_path = date('Y-m-d');
                $product->image = $filename;
            endif;
            $product->price = $request->input('price');
            $product->in_discount = $request->input('indiscount');
            $product->discount = $request->input('discount');
            $product->content = e($request->input('content'));
            $id = Auth::id();
            $product->vendedorid = $id;
            if($product->save()):
                if($request->hasFile('img')): //consulta a la peticion si el archivo cuenta con una iamgen
                    $fl = $request->img->storeAs($path, $filename, 'uploads');
                    $img = Image::make($final_file);
                    $img->fit(256, 256, function($constraints){
                        $constraints->upsize();
                    });
                    $img->save($upload_path.'/'.$path.'/t_'.$filename);
                    unlink($upload_path.'/'.$imgPrevPath.'/'.$imgPrev);
                    unlink($upload_path.'/'.$imgPrevPath.'/t_'.$imgPrev);
                endif;
                return back()->with('message', 'Inmueble: "'.$product->name.'"" editado con exito en el sistema')->with('typealert', 'success');
            endif;
        endif;

    }
    public function postProductGalleryAdd($id, Request $request){
        $rules = [
            'file_image' => 'required'
        ];
        $messages = [
            'file_image.required' => 'Seleccione por lo menos una imagen adicional'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'danger')->withInput();
        else:
            /*foreach($request->file('file_image') as $file_image){*/
            if($request->hasFile('file_image')):
                
                $path = '/'.date('Y-m-d'); 
                $fileExt = trim($request->file('file_image')->getClientOriginalExtension()); 
                $upload_path = Config::get('filesystems.disks.uploads.root');
                $name = Str::slug(str_replace($fileExt,'', $request->file('file_image')->getClientOriginalName()));
                $filename = rand(1,999).'-'.$name.'.'.$fileExt;
                $final_file = $upload_path.'/'.$path.'/'.$filename;
                $g = new PGallery;
                $g->product_id = $id;
                $g->file_path = date('Y-m-d');//aqui se envia date sin el /
                $g->file_name = $filename; 
                if($g->save()):
                if($request->hasFile('file_image')):    
                    $fl = $request->file_image->storeAs($path, $filename, 'uploads');
                    $img = Image::make($final_file);
                    $img->fit(256, 256, function($constraints){
                        $constraints->upsize();
                    });
                    $img->save($upload_path.'/'.$path.'/t_'.$filename);   
                endif;
                return back()->with('message', 'Imagen subida con exito')->with('typealert', 'success');
                endif;
               
            endif;
        /*}*/
        endif;
    }
    public function getProductGalleryDelete($id, $gid){
        $g = PGallery::findOrFail($gid);
        $path = $g->file_path;
        $file = $g->file_name;
        $upload_path = Config::get('filesystems.disks.uploads.root');
        if($g->product_id != $id){
                return back()->with('message', 'Imagen no se puede eliminar')->with('typealert', 'danger');
        }else {
            if($g->delete()):
                unlink($upload_path.'/'.$path.'/'.$file);
                unlink($upload_path.'/'.$path.'/t_'.$file);
                return back()->with('message', 'Imagen eliminada exitosamente')->with('typealert', 'success'); 
            endif;  
        }
    }
    public function fetch(Request $request){
      
        $select = $request->get('select');
        $value = $request->get('value');
        $dependent = $request->get('dependent');
        DB::statement("SET SQL_MODE=''");
        $data = DB::table('location')->where($select, $value)->groupBy($dependent)->get();
        $output = '<option >'.ucfirst($dependent).'</option>';
        foreach($data as $row){
            $output .= '<option value="'.$row->$dependent.'">'.$row->$dependent.'</option>';
        }
        echo $output;
    }
}
