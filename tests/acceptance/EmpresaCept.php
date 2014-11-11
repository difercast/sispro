<?php 

$I = new AcceptanceTester($scenario);

$I->setCookie('username', 'admin');
$I->grabCookie('username');

$I->amLoggedAs(['username'=>'admin','password'=>'admin123']);

$I->amOnPage('/admin');
$I->click('Empresa');
$I->seeCurrentUrlEquals('/empresa');
$I->see('Empresa','h1');
