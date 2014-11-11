<?php 
$I = new AcceptanceTester($scenario);

$I->am('a system admin');
$I->wantTo('go to my home page');

$I->amOnPage('/');
$I->fillField('username','admin');
$I->fillField('password','admin123');
$I->click('Ingresar');

$I->seeCurrentUrlEquals('/admin');

