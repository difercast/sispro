<?php


class ExampleTest extends \vendor\codeception\codeception\src\Codeception\TestCase\Test
#\Codeception\TestCase\Test
{
   /**
    * @var \UnitTester
    */
    protected $tester;

    protected function _before()
    {
        Session::start();
        Route::enableFilters();
    }

    protected function _after()
    {
    }
    // tests
    public function testUserLogin()
    {
        /*
       $credenciales = array(
        'username'=>'admin',
        'password'=>'admin123');
       $response = $this->action('POST','UserLogin@user',null,$credenciales);

       $this->assertRedirectedTo('/admin');*/
    }


}