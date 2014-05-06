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

class AddEstadoToUsers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//Agregamos la columna estado a la tabla users
		Schema::table('users',function($tabla)
		{
			$tabla -> boolean('estado');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//ELiminar la columna de la tabla users
		Schema::table('users',function($tabla)
		{
			$tabla -> dropColumn('estado');
		});
	}

}
