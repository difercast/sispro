<?php 
$I = new FunctionalTester($scenario);

$I->am('a system admin');
$I->wantTo('edit user');

$I->amLoggedAs(['username'=>'admin','password'=>'admin123']);

$I->amOnPage('/admin');
$I->click('Usuarios');

$I->seeCurrentUrlEquals('/user');
$I->click('Editar');
$I->seeCurrentUrlEquals('/user/modificar/1');

$I->fillfield('apellidos','Lituma');
$I->fillfield('sucursal','1');

$I->click('Guardar');

$I->seeCurrentUrlEquals('/user');
