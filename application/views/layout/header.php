<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?= getSettingItem('ComName');?> | FreelancerKlub.com </title>
        <!-- Tell the browser to be responsive to screen width -->  
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">        
        <base href="<?= base_url(); ?>"/>
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="assets/lib/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/admin/dist/css/style.css">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="assets/lib/font-awesome/font-awesome.min.css">
        
        <!-- Theme style -->
        <link rel="stylesheet" href="assets/admin/dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="assets/admin/dist/css/skins/_all-skins.min.css">


        <!-- jQuery 2.2.3 -->
        <script src="assets/lib/plugins/jQuery/jquery-2.2.3.min.js"></script>
        <script src="assets/lib/plugins/jQueryUI/jquery-ui.min.js"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="assets/lib/bootstrap/js/bootstrap.min.js"></script>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <link rel="stylesheet" href="assets/lib/plugins/select2/select2.min.css">   
        <script type='text/javascript' src="assets/lib/plugins/select2/select2.min.js"></script>

        <link href="assets/lib/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css">
        
        <script src="assets/custom/script.js" type="text/javascript"></script>        
        <link href="assets/custom/ajax.css" rel="stylesheet" type="text/css">
        <link href="assets/custom/style.css" rel="stylesheet" type="text/css"/>
        <link href="assets/custom/print.css" rel="stylesheet" type="text/css"/>
    </head>
    
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            <header class="main-header">
                <!-- Logo -->
                <a href="<?= site_url(); ?>" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini">R</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg">                        
                        <?= getSettingItem('comName') ?>
                    </span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                
             
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->
                    <span class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </span>
                    

                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">                             
                            <li class="dropdown ">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-edit"></i> Receive Payment Entry 
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu left-align" role="menu" style="left: 0;">
                                    <!--<li><a href="<?= site_url(Backend_URL . 'trans/income_entry'); ?>"> <i class="fa fa-th"></i> Income </a></li>-->                                                                       
                                    <li><a href="<?= site_url(Backend_URL . 'trans/subscripton'); ?>"> <i class="fa fa-refresh"></i> For Member </a></li>
                                    <li><a href="<?= site_url(Backend_URL . 'trans/expense_entry'); ?>"> <i class="fa fa-exchange"></i> For Ledger  </a></li>                                    
                                    <li><a href="<?= site_url(Backend_URL . 'trans/banking_entry'); ?>"> <i class="fa fa-cart-plus"></i> For Banking </a></li>                                    
                                    <li><a href="<?= site_url(Backend_URL . 'member/create'); ?>"> <i class="fa fa-user-plus"></i> Member Registration </a></li>                                    
                                </ul>
                            </li>
                            <li>
                                <a href="trans">
                                    <i class="fa fa-bar-chart-o"></i>
                                    Report
                                </a>                                
                            </li>
                            <li class="dropdown ">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-gear"></i> Setup 
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu left-align" role="menu" style="left: 0;">                                    
                                    <li><a href="<?= site_url(Backend_URL . 'trans/head'); ?>"> <i class="fa fa-exchange"></i> Ledger/Heads </a></li>                                    
                                    <li><a href="<?= site_url(Backend_URL . 'bank/create'); ?>"> <i class="fa fa-cart-plus"></i> Add Bank Account </a></li>                                    
                                    <li><a href="<?= site_url(Backend_URL . 'sms/template'); ?>"> <i class="fa fa-user-plus"></i> SMS Template </a></li>                                    
                                </ul>
                            </li>
                            
                            
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="assets/logo.jpg" class="user-image" alt="Logo">
                                    <span class="hidden-xs"><?= getLoginUserData('name');?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="assets/logo.jpg" class="img-circle" alt="Logo">
                                        <p> <?= getLoginUserData('name');?> 
                                            <small><?= getLoginUserData('user_mail');?></small>
                                        </p>
                                    </li>

                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="<?= site_url('profile'); ?>" class="btn btn-default btn-flat">Profile</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="<?= site_url('auth/logout'); ?>" class="btn btn-default btn-flat">Sign out</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>                   
                        </ul>
                    </div>
                </nav>
            </header>
