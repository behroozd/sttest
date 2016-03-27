<?php 
namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;
use App\Presenters\DatePresenter;

class User extends Model {
	protected $table = 'user';
	protected $msg   = '';
	//---------------------------------------------------------
	public function isValid($user, $pass){
		try{
			$val = DB::table('user')
					->where('name', '=', $user)
					->where('pass', '=', md5($pass))
					->get();
			if( count($val)==1 ){
				return true;
			}else{
				$this->msg = "user or password not valid" ;
				return false;
			}
		}catch(QueryException $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}
	//---------------------------------------------------------
	public function getMsg(){
		return $this->msg;
	}
	//---------------------------------------------------------
}
