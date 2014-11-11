<?php 

$I = new FunctionalTester($scenario);

$I->am('admin');
$I->wantTo('edit empresa');

$I->amLoggedAs(['username' => 'admin', 'password' => 'admin123']);
$I->amOnPage('/admin');
$I->click('Sucursales');

$I->seeCurrenturlEquals('/sucursal');
$I->click('Activar');
$I->seeCurrenturlEquals('/sucursal');
$I->see('Se activó la sucursal correctamente');
/*
$I->click('Editar');
$I->seeCurrenturlEquals('/empresa/modificar/1');
$I->see('modificar datos de la empresa');
$I->fillField('razon_comercial','Sisprocompu');
$I->click('Editar');
$I->seeCurrenturlEquals('/empresa');
$I->seeRecord('empresas', array('razon_comercial' => 'Sisprocompu'));*/