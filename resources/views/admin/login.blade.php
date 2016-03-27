<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

	<meta name="_token" content="{!! csrf_token() !!}" />
	
    <title>Login</title>

	<base href="<?=url();?>/" />
    <link rel="stylesheet" type="text/css" href="css/admin/bootstrap.css"    />
    <link rel="stylesheet" type="text/css" href="css/admin/metisMenu.css"    />
    <link rel="stylesheet" type="text/css" href="css/admin/font-awesome.css" />
	@yield('css')
    <link rel="stylesheet" type="text/css" href="css/admin/admin.css"        />

    <script type="text/javascript" src="js/admin/jquery.js"></script>
</head>
<body>
    <div id="wrapper">
		@yield('main')
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
	<script type="text/javascript" src="js/admin/bootbox.js"></script>
	<script type="text/javascript" src="js/admin/bootstrap.js"></script>
	<script type="text/javascript" src="js/admin//metisMenu.js"></script>
	<script type="text/javascript" src="js/admin//admin.js"></script>
	
	@yield('script')
</body>
</html>
