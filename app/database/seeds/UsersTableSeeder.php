<?php
class UsersTableSeeder extends Seeder
{
	public function run()
	{
		$users = [
				'nombres' => 'Walter',
				'apellidos' => 'Alvarado',
				'direccion' => 'Sucre 05-25 entre Colón e Imbabura',
				'email' => 'alw0702@gmail.com',
				'telefono' => '2585136',
				'celular'=>'0994794694',				
				'cedula' => '0702568130',
				'username' => 'admin',
				'password' => Hash::make('admin123'),
				'rol' => 'administrador',
				'sucursal_id'=>'1'
		];
		DB::table('users')->insert($users);
	}
}