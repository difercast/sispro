<?php 
$I = new AcceptanceTester($scenario);

$I->am('a system user');
$I->wantTo('ckeck if te index page works');

$I->amOnPage('/');
$I->see('Ingreso usuarios');
