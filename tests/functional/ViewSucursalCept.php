<?php 
$I = new FunctionalTester($scenario);

$I->am('a system admin');
$I->wantTo('view sucursal´s data');

$I->amLoggedAs(['username' => 'admin', 'password' => 'admin123']);
$I->amOnPage('sucursal');

$I->click('Ver');
$I->seeCurrenturlEquals('/sucursal/ver/1');
$I->see('Información de Matriz','h2');
