<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquiposTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('equipos',function($tabla){
			$tabla -> create();
			$tabla -> increments('id');
			$tabla -> string('serie');
			$tabla -> string('tipo');
			$tabla -> string('marca');
			$tabla -> string('modelo');		
			$tabla -> foreign('cliente_id')->references('id')->on('clientes');
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
		Schema::drop('equipos');
	}

}
