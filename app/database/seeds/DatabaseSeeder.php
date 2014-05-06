<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();
		$this->call('ClientesTableSeeder');
		$this->call('EmpresasTableSeeder');
		$this->call('SucursalesTableSeeder');
		$this->call('UsersTableSeeder');
	}

}