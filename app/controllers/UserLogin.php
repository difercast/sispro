<?php

/** 
* Sistema de gestión de reparaciones de equipos informáticos de la empresa Sisprocompu
* @version: 1.0      @modificado: 10 de abril del 2014
* @author: Diego Castillo.
*
*/
class UserLogin extends BaseController
{
	
	/**
    * Validar datos de usuario y redireccionar a la página
    *  según el rol del mismo
    * @param
    * @return Response
    **/
	public function user()
	{		
        $userdata = array(
            'username' => Input::get('username'),
            'password' => Input::get('password')
        );
        if(Auth::attempt($userdata)){
            $idSuc = Auth::user()->sucursal_id;
            $sucursal = Sucursal::find($idSuc);
            $estadoSuc = $sucursal->estado;
        	if(Auth::user()->rol == "administrador" && Auth::user()->estado == "1" && $estadoSuc == '1'){
        		return Redirect::route('administrador');              	           
        	}elseif (Auth::user()->rol == "tecnico" && Auth::user()->estado == "1" && $estadoSuc == '1'){
               $clientes = Cliente::all();
               return Redirect::route('tecnico');
            }elseif (Auth::user()->rol == "vendedor" && Auth::user()->estado == "1" && $estadoSuc == '1') {
               return Redirect::route('vendedor');
            }else{
                return  Redirect::route('index')->with('error',true);    
            }           
        }else{        	
        	return  Redirect::route('index')->with('login_errors',true);
        }    
	}

	/**
    * Cerrar la sesión del usuario
    * @param
    * @return Response
    **/
	public function out()
	{
		Auth::logout();
		return  Redirect::route('index');
	}
}


