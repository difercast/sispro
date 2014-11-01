<?php 

$I = new FunctionalTester($scenario);

$I->am('admin');
$I->wantTo('edit empresa');
//$I->haveAnAccount(['admin'=>'admin','password'=>'admin123']);
$I->amLoggedAs(['username' => 'admin', 'password' => 'admin123']);
//$I->amHttpAuthenticated('admin','admin123');
$I->amOnPage('/empresa');
$I->click('Editar');
$I->seeCurrenturlEquals('/empresa/modificar/1');
$I->see('modificar datos de la empresa');
$I->click('Editar');
$I->seeCurrenturlEquals('/empresa');

