@extends('admin.template')

@section('css')

	<link rel="stylesheet" type="text/css" href="css/admin/dataTables.css"   />
	<link rel="stylesheet" type="text/css" href="css/admin/jquery.fileupload.css" />
	
@stop

@section('main')
	<br/>
	<div class="panel panel-primary" >
		<div class="panel-heading">Products</div>
		<div class="panel-body">
			<table id="dataTable" class="hover display" width="100%" >
				<thead>
					<th width="250">Title</th>
					<th width="50">Price</th>
					<th>Description</th>
					<th width="10"></th>
					<th width="10"></th>
					<th width="10"></th>
				</thead>
				<tbody></tbody>
			</table>
		</div>
		<div class="panel-footer">
			<button class="btn btn-default" onclick="callDataTableReload()"><i class="fa fa-refresh"></i></button>
			<button class="btn btn-primary" onclick="callDialog(0,0)"><i class="fa fa-plus"></i></button>
		</div>
	</div>
	
	<div id="myModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<!--<div class="modal-header">Insert</div>-->
				<div class="modal-body">
					<input type="hidden" id="act" value="" />
					<input type="hidden" id="id"  value="" />
	
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
						<input type="checkbox" name="size" id="sizeA" /><label for='sizeA'>Size A</label>
						&nbsp;&nbsp;
						<input type="checkbox" name="size" id="sizeB" /><label for='sizeB'>Size B</label>
						&nbsp;&nbsp;
						<input type="checkbox" name="size" id="sizeC" /><label for='sizeC'>Size C</label>
						&nbsp;&nbsp;
						<input type="checkbox" name="size" id="sizeD" /><label for='sizeD'>Size D</label>
						&nbsp;&nbsp;
						<input type="checkbox" name="size" id="sizeE" /><label for='sizeE'>Size E</label>
						&nbsp;&nbsp;
						<input type="checkbox" name="size" id="sizeF" /><label for='sizeF'>Size F</label>
						&nbsp;&nbsp;
						<input type="checkbox" name="size" id="sizeG" /><label for='sizeG'>Size G</label>
						&nbsp;&nbsp;
					</div>
					
					<div class="form-group has-feedback">
						<label for="color">Color</label><br />
						<input type="checkbox" name="color" id="red" />
							<label for='red'><span class="color" style="background:red;">&nbsp;</span></label>
						&nbsp;&nbsp;
						<input type="checkbox" name="color" id="green" />
							<label for='green'><span class="color" style="background:green;">&nbsp;</span></label>
						&nbsp;&nbsp;
						<input type="checkbox" name="color" id="blue" />
							<label for='blue'><span class="color" style="background:blue;">&nbsp;</span></label>
						&nbsp;&nbsp;
						<input type="checkbox" name="color" id="black" />
							<label for='black'><span class="color" style="background:black;">&nbsp;</span></label>
						&nbsp;&nbsp;
						<input type="checkbox" name="color" id="white" />
							<label for='white'><span class="color" style="background:white;">&nbsp;</span></label>
						&nbsp;&nbsp;
						<input type="checkbox" name="color" id="yellow" />
							<label for='yellow'><span class="color" style="background:yellow;">&nbsp;</span></label>
						&nbsp;&nbsp;
						<input type="checkbox" name="color" id="brown" />
							<label for='brown'><span class="color" style="background:brown;">&nbsp;</span></label>
						&nbsp;&nbsp;
					</div>
					
				</div>
				<div class="modal-footer" align="left">
					<button type="button" class="btn btn-primary" onclick="callAction()" id="action"></button>
					<button type="button" class="btn btn-outline btn-default" data-dismiss="modal">Close <i class="fa fa-times"></i></button>
				</div>
			</div>
		</div>
	</div>
	
	<div id="myImage" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<div id="progress" class="progress">
						<div class="progress-bar progress-bar-info"></div>
					</div>
					<input type="hidden" id="idProduct"  value="" />
				</div>
				<div class="modal-body">
				</div>
				<div class="modal-footer" align="left">
					<span class="btn btn-info fileinput-button">
						<span>Upload</span>
						&nbsp;
						<i class="fa fa-upload"></i>
						<input id="fileupload" type="file" name="files[]" />
					</span>
					<button type="button" onclick="closeImageDialog()" class="btn btn-outline btn-default">Close <i class="fa fa-times"></i></button>
				</div>
			</div>
		</div>
	</div>
@stop

@section('script')

	<script type="text/javascript" src="js/admin//dataTables.js"></script>
	<script type="text/javascript" src="js/admin//dataTables.bootstrap.min.js"></script>
	<script type="text/javascript" src="js/admin/jquery.ui.widget.js"></script>
	<script type="text/javascript" src="js/admin/jquery.iframe-transport.js"></script>
	<script type="text/javascript" src="js/admin/jquery.fileupload.js"></script>

	<script type="text/javascript" src="js/admin/products.js"></script>
	
@stop
