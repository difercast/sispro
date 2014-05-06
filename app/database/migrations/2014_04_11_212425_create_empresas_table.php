<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('empresas', function($tabla)
		{
			$tabla -> create();
			$tabla -> increments('id');
			$tabla -> string('ruc',13);
			$tabla -> string('actividad');
			$tabla -> string('razon_social');
			$tabla -> string('razon_comercial');
			$tabla -> timestamps();
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('empresas');
	}

}