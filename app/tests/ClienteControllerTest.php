<?php

class ClienteControllerTest extends TestCase {
	
	public function testUserLogin()
    {
       $response = $this->call('GET','/empresa');
       $this->assertTrue(strpos($response->getContent(),'Sisprocompu') !== false);
    }

}