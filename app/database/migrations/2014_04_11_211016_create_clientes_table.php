<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('clientes',function($tabla){
			$tabla-> create();
			$tabla-> increments('id');
			$tabla-> string('apellidos');
			$tabla-> string('nombres');
			$tabla-> string('cedula');
			$tabla-> string('direccion');
			$tabla-> string('telefono');
			$tabla-> string('celular');
			$tabla-> string('email')->unique();
			$tabla-> string('observaciones');
			$tabla-> timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('clientes');
	}

}
