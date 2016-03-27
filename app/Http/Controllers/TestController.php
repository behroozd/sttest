<?php 
namespace App\Http\Controllers;
//-------------------------------------------------------------
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use App\Http\Test\ExampleTest;
//-------------------------------------------------------------
class TestController extends Controller {
	public function __construct()
	{
		$this->middleware('guest');
	}
	//---------------------------------------------------------
	public function index(Request $request){
		$test = new ExampleTest();
		return view('test', array('isLogin'=>$request->session()->get('isLogin')) );
	}
	//---------------------------------------------------------
}
