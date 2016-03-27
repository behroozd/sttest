@extends('admin.login')
@section('main')
	<div class="panel panel-primary" style="width:400px;margin:auto;margin-top:50px;">
		<div class="panel-heading">Login</div>
		<div class="panel-body">

			<div class="form-group has-feedback">
				<label for="user">User</label>
				<span class="form-control-feedback"><i class="fa fa-user"></i></span>
				<input type="text" class="form-control" placeholder="user name" id="user" value="" />
			</div>
			
			<div class="form-group has-feedback">
				<label for="password">Password</label>
				<span class="form-control-feedback"><i class="fa fa-key"></i></span>
				<input type="password" class="form-control" placeholder="password" id="password" value="" />
			</div>
			
		</div>
		<div class="panel-footer">
			<button class="btn btn-info btn-outline" onClick="callLogin('<?=url('admin');?>')">login <i class="fa fa-search"></i></button>
			<a class="btn btn-default btn-outline" href="<?=url();?>" ><i class="fa fa-home"></i></a>
		</div>
	</div>
@stop
@section('script')

	<script type="text/javascript" src="js/admin/login.js"></script>
	
@stop
