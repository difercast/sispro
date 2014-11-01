<?php 
$I = new FunctionalTester($scenario);
$I->am('user');
$I->wantTo('a signing');

$I->amOnPage('/');
$I->fillField('username','admin');
$I->fillField('password','admin123');
$I->click('Ingresar','input[type="submit"]');

$I->seeCurrentUrlEquals('/admin');
$I->see('Sisprocompu - Matriz','h2');




