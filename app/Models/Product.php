<?php 
namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;
use App\Presenters\DatePresenter;

class Product extends Model {
	protected $table = 'product';
	protected $msg   = '';
	//---------------------------------------------------------
	public function getMsg(){
		return $this->msg;
	}
	//---------------------------------------------------------
	public function productList(){
		try{
			$products = DB::table($this->table)->get();
			return $products;
		}catch(QueryException $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}
	//---------------------------------------------------------
	public function get($id){
		try{
			$val = DB::table($this->table)->where('id', '=', $id)->get();
			$val[0]->size  = unserialize($val[0]->size );
			$val[0]->color = unserialize($val[0]->color);
			return $val;
		}catch(QueryException $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}
	//---------------------------------------------------------
	public function insert($data){
		try{
			$size  = serialize( $data['size' ] );
			$color = serialize( $data['color'] );
			$id = DB::table($this->table)
					->insert(['title'=>$data['title'], 'price'=>$data['price'], 'description'=>$data['description'], 'size'=>$size, 'color'=>$color, 'last'=>'now()']);
			return true;
		}catch(QueryException $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}
	//---------------------------------------------------------
	public function deleteRec($id){
		try{
			DB::table($this->table)
					->where('id', '=', $id)
					->delete();
			return true;
		}catch(QueryException $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}
	//---------------------------------------------------------
	public function updateRec($id, $data){
		try{
			$size  = serialize( $data['size' ] );
			$color = serialize( $data['color'] );
			DB::table($this->table)
					->where('id', '=', $id)
					->update(['title'=>$data['title'], 'price'=>$data['price'], 'description'=>$data['description'], 'size'=>$size, 'color'=>$color, 'last'=>'now()']);
			return true;
		}catch(QueryException $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}
	//---------------------------------------------------------
	public function setImage($id, $data){
		try{
			DB::table($this->table)
					->where('id', '=', $id)
					->update( ['image' => $data['file'], 'last'=>'now()'] );
			return true;
		}catch(QueryException $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}
	//---------------------------------------------------------
}

