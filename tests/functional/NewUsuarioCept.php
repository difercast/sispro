<?php 
$I = new FunctionalTester($scenario);

$I->am('a system admin');
$I->wantTo('create a new user');

$I->amLoggedAs(['username'=>'admin','password'=>'admin123']);

$I->amOnPage('/admin');
$I->click('Usuarios');

$I->seeCurrentUrlEquals('/user');
$I->click('Nuevo');
$I->seeCurrentUrlEquals('/user/nuevo');

$I->fillfield('apellidos','Castillo');
$I->fillfield('nombres','Diego');
$I->fillfield('cedula','1104537228');
$I->fillfield('direccion','balcon');
$I->fillfield('telefono','');
$I->fillfield('celular','0979365042');
$I->fillfield('username','difercast');
$I->fillfield('password','raton1104');
$I->fillfield('password2','raton1104');

$I->click('Guardar');

$I->seeCurrentUrlEquals('/user');


