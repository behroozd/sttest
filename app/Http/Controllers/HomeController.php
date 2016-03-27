<?php 
namespace App\Http\Controllers;
//-------------------------------------------------------------
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Product;
//-------------------------------------------------------------
class HomeController extends Controller {
	public function __construct()
	{
		$this->middleware('guest');
	}
	//---------------------------------------------------------
	public function index(Request $request){
		$prd = new Product();
		$products = $prd->productList();
		return view('home', array('isLogin'=>$request->session()->get('isLogin'), 'products'=>$products) );
	}
	//---------------------------------------------------------
}
