<?php 

$I = new FunctionalTester($scenario);

$I->am('admin');
$I->wantTo('edit empresa');

$I->haveAnAccount(['username' => 'admin']);
$I->amOnPage('/admin');
$I->see('Sisprocompu - Matriz', 'h2');
$I->dontSee('Exception');



