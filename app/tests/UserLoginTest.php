<?php

class UserLoginTest extends TestCase {

	public function testUserLogin()
    {
       
       $credenciales = array(
        'username'=>'admin',
        'password'=>'admin123');
       $response = $this->action('POST','UserLogin@user',null,$credenciales);
       $this->assertRedirectedTo('/admin');
       
    }

}