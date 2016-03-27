<?php
//-------------------------------------------------------------
use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

//use JWTAuth;
//-------------------------------------------------------------
class ExampleTest extends TestCase {
	//-------------------------------------------------------------------------------------
	public function testHomeApplication(){
		return $response = $this->action('GET', 'HomeController@index');
	}
	//-------------------------------------------------------------------------------------
	public function testAdminApplication(){
		return $response = $this->action('GET', 'AdminController@index');
	}
	//-------------------------------------------------------------------------------------
	public function testGetProduct(){
		$response = $this->call('GET', '/products');
		return $this->assertEquals(200, $response->getStatusCode());
	}
	//-------------------------------------------------------------------------------------
	public function testPostProduct(){
		Session::start(); // Start a session for the current test
        	$params = [
	            '_token' => csrf_token()
        	];

        $response = $this->call('POST', 'products/delete/0', $params);

		return $this->assertEquals(200, $response->getStatusCode());
	}
	//-------------------------------------------------------------------------------------
}
