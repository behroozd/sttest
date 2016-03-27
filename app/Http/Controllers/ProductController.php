<?php 
namespace App\Http\Controllers;
//-------------------------------------------------------------
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Mail\PHPMailer;

use App\Models\Product;
//-------------------------------------------------------------
class ProductController extends Controller {

	public function __construct(){
		//	$this->middleware('admin', ['except' => ['create', 'store']]);
		//	$this->middleware('ajax', ['only' => 'update']);
	}

	public function index(){
		return $this->productsList();
	}

	public function create(){
		return view('front.contact');
	}

	//---------------------------------------------------------
	public function show( Request $request, $id ){
		if($id==0){
			return $this->productsList();
		}else{
			return $this->productGet($id);
		}
	}
	//---------------------------------------------------------
	public function productsList(){
		$prd = new Product();
		$products = $prd->productList();
		if( $products==false ){
			return response()->json(['sEcho'=>1, 'iTotalRecords'=>1, 'iTotalDisplayRecords'=>1, 'aaData'=>array() ]);
		}else{
			$data = array();
			foreach( $products as $product ){
				array_push($data, 
					array(
						$product->title, 
						$product->price, 
						$product->description,
						"<i class='act fa fa-edit' title='Edit' onclick='callDialog(1,{$product->id})'></i>",
						"<i class='act fa fa-file-photo-o' title='Upload Image' onclick='callImage({$product->id})'></i>",
						"<i class='act fa fa-trash' title='Delete' onclick='callDialog(2,{$product->id})'></i>",
					));
			}
			if( count($data)==0 ){ return response()->json(['sEcho'=>1, 'iTotalRecords'=>1, 'iTotalDisplayRecords'=>1, 'aaData'=>array() ]); }
			else{ return response()->json(['sEcho'=>1, 'iTotalRecords'=>1, 'iTotalDisplayRecords'=>1, 'aaData'=>$data ]); }
		}
	}
	//---------------------------------------------------------
	public function productGet($id){
		try{
			$prd = new Product();
			$product = $prd->get($id);
			if( $product==false ){
				return response()->json(['result'=>1, 'msg'=>$prd->getMsg() ]);
			}else{
				return response()->json(['result'=>0, 'data'=>$product]);
			}
		}catch(Exception $e){
			return response()->json(['result'=>1, 'msg'=>$e->getMessage() ]);
		}
	}
	//---------------------------------------------------------
	public function store( Request $request, $action, $id ){
		switch( $action ){
			case 'delete':{
				return $this->productDelete($id);
			}
			case 'insert':{
				return $this->productInsert($_POST['data']);
			}
			case 'update':{
				return $this->productUpdate($id, $_POST['data']);
			}
			case 'setimage':{
				return $this->productSetImage($id, $_POST['data']);
			}
			case 'buy':{
				return $this->productBuy($id, $_POST['data']);
			}
		}
	}
	//---------------------------------------------------------
	public function productInsert($data){
		try{
			$prd = new Product();
			$product = $prd->insert($data);
			if( $product==false ){
				return response()->json(['result'=>1, 'msg'=>$prd->getMsg() ]);
			}else{
				return response()->json(['result'=>0]);
			}
		}catch(Exception $e){
			return response()->json(['result'=>1, 'msg'=>$e->getMessage() ]);
		}
	}
	//---------------------------------------------------------
	public function productDelete($id){
		try{
			$prd = new Product();
			$product = $prd->deleteRec($id);
			if( $product==false ){
				return response()->json(['result'=>1, 'msg'=>$prd->getMsg() ]);
			}else{
				return response()->json(['result'=>0]);
			}
		}catch(Exception $e){
			return response()->json(['result'=>1, 'msg'=>$e->getMessage() ]);
		}
	}
	//---------------------------------------------------------
	public function productUpdate($id, $data){
		try{
			$prd = new Product();
			$product = $prd->updateRec($id, $data);
			if( $product==false ){
				return response()->json(['result'=>1, 'msg'=>$prd->getMsg() ]);
			}else{
				return response()->json(['result'=>0]);
			}
		}catch(Exception $e){
			return response()->json(['result'=>1, 'msg'=>$e->getMessage() ]);
		}
	}
	//---------------------------------------------------------
	public function productSetImage($id, $data){
		try{
			$prd = new Product();
			$product = $prd->setImage($id, $data);
			if( $product==false ){
				return response()->json(['result'=>1, 'msg'=>$prd->getMsg() ]);
			}else{
				return response()->json(['result'=>0]);
			}
		}catch(Exception $e){
			return response()->json(['result'=>1, 'msg'=>$e->getMessage() ]);
		}
	}
	//---------------------------------------------------------
	public function productBuy($id, $data){
		try{
			$config = parse_ini_file( 'email.ini', true );
			
			$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->CharSet   = "UTF-8";
			$mail->SMTPAuth  = true;
			$mail->SMTPDebug = 0;
			$mail->isHTML(true);

			$mail->Host       = $config['email']['host'      ];
			$mail->Port       = $config['email']['port'      ];
			$mail->Username   = $config['email']['username'  ];
			$mail->Password   = $config['email']['password'  ];
			$mail->SMTPSecure = $config['email']['smtpsecure'];

			$mail->From       = $config['email']['username'  ];
			$mail->FromName   = $config['email']['sendername'];

			$mail->addAddress( $config['email']['to'], 'Test' );

			$mail->Subject = $data['title'];
			$mail->Body    = 
				"<b>Title</b>: <i>{$data['title']}</i><br/>".
				"<b>Name</b> : <i>{$data['name']}</i><br/>".
				"<b>Email</b>: <i>{$data['email']}</i><br/>".
				"<b>Price</b>: <i>{$data['price']}</i><br/>".
				"<b>Color</b>: ";
			foreach( $data['color'] as $color ){
				if($color!='0'){ $mail->Body.="<i>{$color}</i>, "; }
			}
			$mail->Body    .= "<br/><b>Size</b>: ";
			foreach( $data['size'] as $size ){
				if($size!='0'){ $mail->Body.="<i>{$size}</i>, "; }
			}
			$mail->Body    .= "<br/><hr/>";

			$mail->AltBody = "{$data['title']}";
			if($data['image']!=''){
				$mail->AddAttachment( "{$_SERVER['SERVER_NAME']}/sttest/public/product/images/{$data['id']}/{$data['image']}" );
			}

			if(!$mail->send()){
				return response()->json(['result'=>1, 'msg'=>"Can't send email.<br/>Mailer Error: " . $mail->ErrorInfo ]);
			}else{
				$mail->Body    = 
					"<b>Title</b>: <i>{$data['title']}</i><br/>".
					"<b>Price</b>: <i>{$data['price']}</i><br/>".
					"<b>Color</b>: ";
				foreach( $data['color'] as $color ){
					if($color!='0'){ $mail->Body.="<i>{$color}</i>, "; }
				}
				$mail->Body    .= "<br/><b>Size</b>: ";
				foreach( $data['size'] as $size ){
					if($size!='0'){ $mail->Body.="<i>{$size}</i>, "; }
				}
				$mail->Body    .= "<br/><hr/>";
				$mail->ClearAddresses();
				$mail->addAddress( $data['email'], $data['name'] );
				$mail->send();
				return response()->json(['result'=>0 ]);
			}
		}catch(\Swift_TransportException $e){
			return response()->json(['result'=>1, 'msg'=>$e->getMessage() ]);
		}
	}
	//---------------------------------------------------------
	public function update(
		ProductRepository $contact_gestion,
		Request $request, 		 
		$id)
	{
	//	$contact_gestion->update($request->input('seen'), $id);

	//	return response()->json(['statut' => 'ok']);
	}
	//---------------------------------------------------------
	public function destroy(
		ProductRepository $contact_gestion, 
		$id)
	{
	//	$contact_gestion->destroy($id);
		
	//	return redirect('contact');
	}
	//---------------------------------------------------------
}
