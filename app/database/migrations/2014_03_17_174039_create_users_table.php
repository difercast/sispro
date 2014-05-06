<?php
/** 
*
* @Sistema de gestión de reparaciones de equipos informáticos de Sisprocompu
* @versión: 1.0      @modificado: 17 de marzo del 2014
* @autor: Diego C.
*
*/
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users',function($tabla)
		{
		
			$tabla -> increments('id');

			$tabla -> string('nombres');
			$tabla -> string('apellidos');
			$tabla -> string('direccion'); 
			$tabla -> string('email');
			$tabla -> string('telefono');
			$tabla -> string('celular');
			$tabla -> string('cedula');
			$tabla -> string('username')->unique();
			$tabla -> string('pass');
			$tabla -> string('rol');			

			$tabla -> timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
