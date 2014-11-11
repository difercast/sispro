<?php 
$I = new FunctionalTester($scenario);

$I->am('a system admin');
$I->wantTo('view user´s data');

$I->amLoggedAs(['username' => 'admin', 'password' => 'admin123']);
$I->amOnPage('user');

$I->click('Ver');
$I->seeCurrenturlEquals('/user/ver/1');
$I->see('Información del usuario','h2');
