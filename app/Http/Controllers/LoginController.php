<?php namespace App\Http\Controllers;
//-------------------------------------------------------------
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User;
//-------------------------------------------------------------
class LoginController extends Controller {
	//---------------------------------------------------------
	public function __construct(){
		$this->middleware('guest');
	}
	//---------------------------------------------------------
	public function index(Request $request){
		$request->session()->put('isLogin','false');
		return view('login',array( 'page'=>'' ));
	}
	//---------------------------------------------------------
	public function store(Request $request, $act){
		$data = $_POST['data'];
		switch( $act ){
			case 'checkuser':{
				$request->session()->put('isLogin','false');
				$user = new User();
				if( $user->isValid($data['user'], $data['password']) ){
					$request->session()->put('isLogin','true');
					return response()->json(['result'=>0]);
				}else{
					return response()->json(['result'=>1, 'msg'=>$user->getMsg() ]);
				}
				break;
			}
		}
	}
	//---------------------------------------------------------
}
//-------------------------------------------------------------
