<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdenesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ordenes',function($tabla)
		{
			$tabla -> create();
			$tabla -> increments('id');
			$tabla -> foreign('cliente_id')->references('id')->on('clientes')->onUpdate('cascade');
			$tabla -> foreign('equipo_id')->references('id')->on('equipos')->onUpdate('cascade');
			$tabla -> string('problema');
			$tabla -> string('accesorios');
			$tabla -> foreign('user_id')->references('id')->on('users')->onUpdate('cascade');
			$tabla -> foreign('tecnico')->references('id')->on('users')->onUpdate('cascade');
			$tabla -> string('horaPrometido');
			$tabla -> date('fechaPrometido');
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
		Schema::drop('ordenes');
	}

}
