<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePresupuestosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('presupuestos',function($tabla)
		{
			$tabla->increments('id');
			$tabla->string('detalle');
			$tabla->double('valor');
			$tabla->double('valorIVA');
			$tabla->timestamps();
		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('presupuestos');
	}

}
