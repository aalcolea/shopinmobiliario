<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator, Hash, Auth, Mail;
use App\User;
use App\Mail\UserSendRecover;

class ConnectController extends Controller
{
    public function __construct(){
        $this->middleware('guest')->except(['getLogout']);
    }
    public function getLogin(){
        return view('connect.login'); //view sirve para mostrar una vista lol
    }
    public function postLogin(Request $request){
        $rules = [
            'email' => 'required|email',
            'password' => 'required|min:8'
        ];
        $messages = [
            'email.required' => 'Correo electronico requerido',
            'email.email' => 'Formato de correo incorrecto',
            'password.required' => 'Por favor escriba una contrasena',
            'password.min' => 'La contrasena debe contener al menos 8 caracteres'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);//metdo make recojo los valores enviados de un form
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Se ha producdio un error')->with('typealert', 'danger');
        else:
            if(Auth::attempt(['email'=>$request->input('email'), 'password'=>$request->input('password')], true)):
                if(Auth::user()->status=="100"):
                    return redirect('/logout');
                else:
                    return redirect('/');
                endif;
            else:
                return back()->with('message', 'Usuario o contrasena incorrecta')->with('typealert', 'danger');    
            endif;    
        endif;
    }
    public function getLogout(){
        $status = Auth::user()->status;
        Auth::logout();
        if($status ==  "100"):
            return redirect('/login')->with('message', 'Usuario se encuentra suspendido, por favor contactar a un administrador')->with('typealert', 'danger');
        else: 
        return redirect('/');

    endif;
    }
    public function getRegister(){
        return view('connect.register');
    }
    public function postRegister(Request $request){
        $rules = [
            'name' => 'required',
            'lastname' => 'required',
            'number' => 'required|numeric|unique:users,number|min:10',
            'email' => 'required|email|unique:users,email',
            'password' => 'required:min:8',
            'cpassword' => 'required|same:password',
            'location' => 'required'
        ];
        $messages = [
            'name.required' => 'Nombre requerido',
            'lastname.required' => 'Apellido requerido',
            'number.required' => 'Numero es necesario',
            'number.numeric' => 'Numero en formato incorrecto',
            'number.unique' => 'Ya existe ese numero registrado',
            'number.min' => 'Numero con almenos 10 digitos',
            'email.required' => 'Correo electronico requerido',
            'email.email' => 'Formato de correo incorrecto',
            'email.unique' => 'Ya existe una cuenta con este correo registrado',
            'password.required' => 'Por favor escriba una contrasena',
            'password.min' => 'La contrasena debe contener al menos 8 caracteres',
            'cpassword.required' => 'Favor de confirmar su contrasena',
            'cpassword.same' => 'Las contrasenas no coinciden',
            'location.required' => 'Por favor indica de donde te registras'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
    if($validator->fails()):
        return back()->withErrors($validator)->with('message', 'Se ha producdio un error')->with('typealert', 'danger');
    else:
        $user = new User;
        $user->name = e($request->input('name'));
        $user->lastname = e($request->input('lastname'));
        $user->number = e($request->input('number'));
        $user->email = e($request->input('email'));
        $user->password = Hash::make($request->input('password'));
        $user->location = e($request->input('location'));
        if($user->save()):
            return redirect('/login')->with('message', 'Usuario creado con exito')->with('typealert', 'info');
        endif;
    endif; 
    }
    public function getRecover(){
        return view('connect.recover');
    }
    public function postRecover(Request $request){
        $rules = [
            'email' => 'required|email|'
        ];
        $messages = [
            'email.required' => 'Correo electronico requerido',
            'email.email' => 'Formato de correo incorrecto',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
    if($validator->fails()):
        return back()->withErrors($validator)->with('message', 'Se ha producdio un error')->with('typealert', 'danger');
    else:
        $user = User::where('email', $request->input('email'))->count();
        if($user == "1"):
            $user = User::where('email', $request->input('email'))->first();
            $code = rand(10000,99999);
            $data = ['name' => $user->name, 'email' => $user->email, 'code'=> $code];
            Mail::to($user->email)->send(new UserSendRecover($data));
            //return view('emails.recover', $data);
        else:
            return back()->withErrors($validator)->with('message', 'Este correo no esta rregistrado')->with('typealert', 'danger');
        endif;
    endif;
    }
}
