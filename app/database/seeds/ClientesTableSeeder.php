<?php
class ClientesTableSeeder extends Seeder
{
	public function run()
	{
		$cliente = [
				'apellidos' => 'Castillo',
				'nombres' => 'Diego',
				'cedula' => '1104537228',
				'telefono' => '585136',				
		];
		DB::table('clientes')->insert($cliente);
	}
}