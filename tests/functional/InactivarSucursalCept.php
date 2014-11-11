<?php 
$I = new FunctionalTester($scenario);

$I->am('a systema admin');
$I->wantTo('Inactivar sucursal');

$I->amLoggedAs(['username' => 'admin', 'password' => 'admin123']);

$I->amOnPage('/sucursal');
$I->click('Inactivar');
$I->seeCurrentUrlEquals('/sucursal');
$I->see('Se inactivó la sucursal correctamente');