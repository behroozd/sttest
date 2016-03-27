<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

	<meta name="_token" content="{!! csrf_token() !!}" />
	
    <title>Home</title>

	<base href="<?=url();?>/" />
    <link rel="stylesheet" type="text/css" href="css/admin/bootstrap.css"    />
	<link rel="stylesheet" type="text/css" href="css/admin/font-awesome.css" />
    <link rel="stylesheet" type="text/css" href="css/home.css"    />
    <script type="text/javascript" src="js/admin/jquery.js"></script>
	</head>
<body>
	<div class='topMenuBar' align="right">
	<?php if($isLogin=='true'): ?>
		<a href="<?=url('admin');?>">Admin panel</a>
	<?php else: ?>
		<a href="<?=url('login');?>">Login</a>
	<?php endif; ?>
	</div>
	<div >
	<?php
	if($products==false){
		?><h3>Error on data</h3><?php
	}else{
		?><div  class='grid'><?php
		foreach( $products as $product ){
			?>
				<div class='grid-item'>
					<button class="btn btn-default btn-outline" style='padding:2px 7px 2px 5px;float:right'
								onclick="callDialog(<?=$product->id;?>)"><i class='fa fa-shopping-cart'></i></button>
					<h6><?=$product->title;?></h6>
					<?php if($product->image!=''):?>
					<img  src="<?=url('product/images/')."/".$product->id."/thumbnail/".$product->image;?>" 
								onclick="callImage(<?=$product->id;?>)" style='cursor:pointer' />
					<?php else:?>
					<img  src="<?=url('product/images/')."/no-photo.jpg";?>" height='80' width='80' />
					<?php endif;?>
					<p><?=((strlen($product->description)>50)?substr($product->description,0,50).'...':$product->description);?></p>
					<p><?=((strlen($product->description)>50)?substr($product->description,0,50).'...':$product->description);?></p>
				</div>
			<?php
		}
		?></div>
		<div id="myImage" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header"></div>
					<div class="modal-body"></div>
					<div class="modal-footer" align="left">
						<button type="button" class="btn btn-outline btn-default" data-dismiss="modal">Close <i class="fa fa-times"></i></button>
					</div>
				</div>
			</div>
		</div>


		<div id="myModal" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<!--<div class="modal-header">Insert</div>-->
					<div class="modal-body">
						<input type="hidden" id="id"  value="" />
						<input type="hidden" id="imgName"  value="" />
		
						<div class="form-group has-feedback">
							<label for="title">Name</label>
							<span class="form-control-feedback"><i class="fa fa-info"></i></span>
							<input type="text" class="form-control" placeholder="Name" id="name" value="" />
						</div>
						
						<div class="form-group has-feedback">
							<label for="title">Email</label>
							<span class="form-control-feedback"><i class="fa fa-info"></i></span>
							<input type="text" class="form-control" placeholder="Email" id="email" value="" />
						</div>
						
						<div class="form-group has-feedback">
							<label for="title">Title</label>
							<span class="form-control-feedback"><i class="fa fa-info"></i></span>
							<input type="text" class="form-control" placeholder="Title" id="title" value="" required />
						</div>
						
						<div class="form-group has-feedback">
							<label for="price">Price</label>
							<span class="form-control-feedback"><i class="fa fa-info"></i></span>
							<input type="number" class="form-control" placeholder="Price" id="price" value="" />
						</div>
						
						<div class="form-group has-feedback">
							<label for="description">Description</label>
							<span class="form-control-feedback"><i class="fa fa-info"></i></span>
							<input type="text" class="form-control" placeholder="Description" id="description" value="" />
						</div>
						
						<div class="form-group has-feedback">
							<label for="size">Size</label><br />
							<span class="sizeA"><input type="checkbox" name="size" id="sizeA" /><label for='sizeA'>Size A</label>&nbsp;&nbsp;<span>
							<span class="sizeB"><input type="checkbox" name="size" id="sizeB" /><label for='sizeB'>Size B</label>&nbsp;&nbsp;<span>
							<span class="sizeC"><input type="checkbox" name="size" id="sizeC" /><label for='sizeC'>Size C</label>&nbsp;&nbsp;<span>
							<span class="sizeD"><input type="checkbox" name="size" id="sizeD" /><label for='sizeD'>Size D</label>&nbsp;&nbsp;<span>
							<span class="sizeE"><input type="checkbox" name="size" id="sizeE" /><label for='sizeE'>Size E</label>&nbsp;&nbsp;<span>
							<span class="sizeF"><input type="checkbox" name="size" id="sizeF" /><label for='sizeF'>Size F</label>&nbsp;&nbsp;<span>
							<span class="sizeG"><input type="checkbox" name="size" id="sizeG" /><label for='sizeG'>Size G</label>&nbsp;&nbsp;<span>
						</div>
						
						<div class="form-group has-feedback">
							<label for="color">Color</label><br />
							<span class='red'>
								<input type="checkbox" name="color" id="red" />
									<label for='red'><span class="color" style="background:red;">&nbsp;</span></label>
								&nbsp;&nbsp;
							</span>
							<span class='green'>
								<input type="checkbox" name="color" id="green" />
									<label for='green'><span class="color" style="background:green;">&nbsp;</span></label>
								&nbsp;&nbsp;
							</span>
							<span class='blue'>
								<input type="checkbox" name="color" id="blue" />
									<label for='blue'><span class="color" style="background:blue;">&nbsp;</span></label>
								&nbsp;&nbsp;
							</span>
							<span class='black'>
								<input type="checkbox" name="color" id="black" />
									<label for='black'><span class="color" style="background:black;">&nbsp;</span></label>
								&nbsp;&nbsp;
							</span>
							<span class='white'>
								<input type="checkbox" name="color" id="white" />
									<label for='white'><span class="color" style="background:white;">&nbsp;</span></label>
								&nbsp;&nbsp;
							</span>
							<span class='yellow'>
								<input type="checkbox" name="color" id="yellow" />
									<label for='yellow'><span class="color" style="background:yellow;">&nbsp;</span></label>
								&nbsp;&nbsp;
							</span>
							<span class='brown'>
								<input type="checkbox" name="color" id="brown" />
									<label for='brown'><span class="color" style="background:brown;">&nbsp;</span></label>
								&nbsp;&nbsp;
							</span>
						</div>
						
					</div>
					<div class="modal-footer" align="left">
						<button type="button" class="btn btn-primary" onclick="callAction()" id="action"></button>
						<button type="button" class="btn btn-outline btn-default" data-dismiss="modal">Close <i class="fa fa-times"></i></button>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
	?>
	</div>
    <script type="text/javascript" src="js/admin/bootbox.js"></script>
    <script type="text/javascript" src="js/admin/bootstrap.js"></script>
    <script type="text/javascript" src="js/masonry.pkgd.min.js"></script>

    <script type="text/javascript" src="js/home.js"></script>
</body>
</html>
