<?php
class EmpresasTableSeeder extends Seeder
{
	public function run()
	{
		$empresa = [
				'ruc' => '0702568130001',
				'actividad' => '001',
				'razon_social' => 'Walter Patricio Alvarado Lituma',
				'razon_comercial' => 'Sisprocompu',				
		];
		DB::table('empresas')->insert($empresa);
	}
}