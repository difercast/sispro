<?php 
$I = new FunctionalTester($scenario);
$I->am('a system admin');
$I->wantTo('create a new sucursal');

$I->amLoggedAs(['username' => 'admin', 'password' => 'admin123']);

$I->amOnPage('/sucursal');
$I->click('Nuevo');
$I->seeCurrentUrlEquals('/sucursal/nuevo');

$I->fillField('provincia','Loja');
$I->fillField('ciudad','Loja');
$I->fillField('direccion','Balcón Lojano');
$I->fillField('telefono','2585136');
$I->fillField('celular','0979365042');
$I->fillField('email','fernandoc@yahoo.es');

$I->click('Guardar', 'input[type="submit"]');
$I->seeCurrentUrlEquals('/sucursal');
$I->seeRecord('sucursales',array('email'=>'fernandoc@yahoo.es'));