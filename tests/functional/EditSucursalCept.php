<?php 
$I = new FunctionalTester($scenario);

$I->am('a system admin');
$I->wantTo('edit a sucursal');

$I->amLoggedAs(['username'=>'admin','password'=>'admin123']);

$I->amOnPage('/sucursal');
$I->click('Editar');
$I->seeCurrentUrlEquals('/sucursal/modificar/1');
$I->see('Editar sucursal','h1');

$I->fillfield('direccion','Sucre 05-25 entre Colon e imbabura');
$I->click('Guardar');
$I->seeCurrentUrlEquals('/sucursal');
$I->see('Sucursales');