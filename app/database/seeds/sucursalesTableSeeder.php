<?php
class SucursalesTableSeeder extends Seeder
{
	public function run()
	{
		$sucursal = [
				'provincia'=>'Loja',
				'ciudad'=>'Loja',
				'direccion'=>'Sucre 05-25 entre Colón e Imbabura',
				'telefono'=>'2595136',
				'celular'=>'',
				'email'=>'alw0702@hotmail.com',
				'empresa_id'=>'1',
				'estado'=>'1',
				'nombre'=>'Matriz'
		];
		DB::table('sucursales')->insert($sucursal);
	}
}