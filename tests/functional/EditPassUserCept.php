<?php 
$I = new FunctionalTester($scenario);

$I->am('a system admin');
$I->wantTo('edit password');

$I->amLoggedAs(['username'=>'admin','password'=>'admin123']);

$I->amOnPage('/admin');
$I->click('Usuarios');

$I->seeCurrentUrlEquals('/user');
$I->click('Editar');
$I->seeCurrentUrlEquals('/user/modificar/1');

$I->click('Cambiar contraseña');
$I->seeCurrentUrlEquals('/user/cambiar/1');

$I->fillfield('password','admin123');
$I->fillfield('password2','admin123');

$I->click('Guardar');

$I->seeCurrentUrlEquals('/user');
$I->see('Información editada con éxito');

