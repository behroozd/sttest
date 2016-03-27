<?php 
namespace App\Http\Controllers;
//-------------------------------------------------------------
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Product;
//-------------------------------------------------------------
class AdminController extends Controller {
	//---------------------------------------------------------
	public function __construct(){
		$this->middleware('guest');
	}
	//---------------------------------------------------------
	public function index(Request $request){
		if( $request->session()->get('isLogin')!='true' ){
			return redirect('login');
		}else{
			return view('admin');
		}
	}
	//---------------------------------------------------------
	public function show(Request $request, $page){
		if( $request->session()->get('isLogin')!='true' ){
			return redirect('login');
		}else{
			return view($page);
		}
	}
	//---------------------------------------------------------
	public function store(Request $request, $page){
	}
	//---------------------------------------------------------
}
//-------------------------------------------------------------
