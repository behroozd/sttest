<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

	<meta name="_token" content="{!! csrf_token() !!}" />
	
    <title>Admin panel</title>

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

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?=url('admin');?>">Admin panel</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- .dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-list fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li class="divider"></li>
                        <li><a href="<?=url();?>"><i class="fa fa-home fa-fw"></i> Home</a></li>
                        <li class="divider"></li>
                        <li><a href="<?=url('login');?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="admin/products"><i class="fa fa-bars fa-fw"></i> Products</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
			@yield('main')
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script type="text/javascript" src="js/admin/bootbox.js"></script>
    <script type="text/javascript" src="js/admin/bootstrap.js"></script>
    <script type="text/javascript" src="js/admin//metisMenu.js"></script>

    <script type="text/javascript" src="js/admin/admin.js"></script>
	@yield('script')
</body>
</html>
