<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" dir="rtl">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
	<meta charset="utf-8" />
	<title>Bujut Dashboard</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1" name="viewport" />
	<meta content="Metronic" name="description" />
	<meta content="" name="author" />
	<!-- BEGIN GLOBAL MANDATORY STYLES -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
	<link href="<?= BackEndUrl ?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	<link href="<?= BackEndUrl ?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
	<link href="<?= BackEndUrl ?>assets/global/plugins/bootstrap/css/bootstrap-rtl.min.css" rel="stylesheet" type="text/css" />
	<link href="<?= BackEndUrl ?>assets/global/plugins/bootstrap-switch/css/bootstrap-switch-rtl.min.css" rel="stylesheet" type="text/css" />
	<!-- END GLOBAL MANDATORY STYLES -->
	<!-- BEGIN PAGE LEVEL PLUGINS -->
	<link href="<?= BackEndUrl ?>assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
	<link href="<?= BackEndUrl ?>assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap-rtl.css" rel="stylesheet" type="text/css" />
	<link href="<?= BackEndUrl ?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
	<link href="<?= BackEndUrl ?>assets/global/plugins/dropzone/dropzone.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= BackEndUrl ?>assets/global/plugins/dropzone/basic.min.css" rel="stylesheet" type="text/css" />
	<!-- <link href="assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" /> -->
	<!-- <link href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" /> -->
	<!-- END PAGE LEVEL PLUGINS -->
	<!-- BEGIN THEME GLOBAL STYLES -->
	<link href="<?= BackEndUrl ?>assets/global/css/components-rtl.min.css" rel="stylesheet" id="style_components" type="text/css" />
	<link href="<?= BackEndUrl ?>assets/global/css/plugins-rtl.min.css" rel="stylesheet" type="text/css" />
	<!-- END THEME GLOBAL STYLES -->
	<!-- BEGIN THEME LAYOUT STYLES -->
	<link href="<?= BackEndUrl ?>assets/layouts/layout/css/layout-rtl.min.css" rel="stylesheet" type="text/css" />
	<link href="<?= BackEndUrl ?>assets/layouts/layout/css/themes/darkblue-rtl.min.css" rel="stylesheet" type="text/css" id="style_color" />
	<link href="<?= BackEndUrl ?>assets/layouts/layout/css/custom-rtl.min.css" rel="stylesheet" type="text/css" />
	<link href="<?= BackEndUrl ?>assets/map.css" rel="stylesheet" type="text/css" />
	<!-- END THEME LAYOUT STYLES -->
	<link rel="shortcut icon" href="favicon.ico" /> </head>
<!-- END HEAD -->

<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
	<div class="page-wrapper">
		<!-- BEGIN HEADER -->
		<div class="page-header navbar navbar-fixed-top">
			<!-- BEGIN HEADER INNER -->
			<div class="page-header-inner ">
				<!-- BEGIN LOGO -->
				<div class="page-logo">
					<a href="<?= AdminPanel ?>main"> <img src="<?= BackEndUrl ?>assets/layouts/layout/img/logo.png" alt="logo" class="logo-default" /> </a>
					<div class="menu-toggler sidebar-toggler"> <span></span> </div>
				</div>
				<!-- END LOGO -->
				<!-- BEGIN RESPONSIVE MENU TOGGLER -->
				<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> <span></span> </a>
				<!-- END RESPONSIVE MENU TOGGLER -->
				<!-- BEGIN TOP NAVIGATION MENU -->
				<div class="top-menu">
					<ul class="nav navbar-nav pull-right">
						<li class="dropdown dropdown-user">
							<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> 
							<!-- <img alt="" class="img-circle" src="<?= BackEndUrl ?>assets/layouts/layout/img/avatar3_small.jpg" />  -->
							<span class="username username-hide-on-mobile"> <?= $_SESSION['name'] ?> </span> <i class="fa fa-angle-down"></i> </a>
							<ul class="dropdown-menu dropdown-menu-default">
								<!-- <li>
									<a href="#"> <i class="icon-user"></i>صفحنى الشحصية </a>
								</li>
								<li class="divider"> </li> -->
								<li>
									<a href="<?= AdminPanel ?>logout"> <i class="icon-key"></i> الخروج </a>
								</li>
							</ul>
						</li>
						<!-- END USER LOGIN DROPDOWN -->
					</ul>
				</div>
				<!-- END TOP NAVIGATION MENU -->
			</div>
			<!-- END HEADER INNER -->
		</div>
		<!-- END HEADER -->
		<!-- BEGIN HEADER & CONTENT DIVIDER -->
		<div class="clearfix"> </div>
		<!-- END HEADER & CONTENT DIVIDER -->
		<!-- BEGIN CONTAINER -->
		<div class="page-container">
			<!-- BEGIN SIDEBAR -->
			<div class="page-sidebar-wrapper">
				<!-- BEGIN SIDEBAR -->
				<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
				<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
				<div class="page-sidebar navbar-collapse collapse">
					<!-- BEGIN SIDEBAR MENU -->
					<!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
					<!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
					<!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
					<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
					<!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
					<!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
					<ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
						<!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
						<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
						<li class="sidebar-toggler-wrapper hide">
							<div class="sidebar-toggler"> <span></span> </div>
						</li>
						<!-- END SIDEBAR TOGGLER BUTTON -->
						<!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
						<li class="sidebar-search-wrapper">
							<!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
							<br>
							<!-- END RESPONSIVE QUICK SEARCH FORM -->
						</li>
						<li class="nav-item start active open">
							<a href="<?= AdminPanel ?>main" class="nav-link nav-toggle"> <i class="icon-settings"></i> <span class="title">الرئيسية</span> <span class="selected"></span> </a>
						</li>
						<li class="nav-item  ">
							<a href="<?= AdminPanel; ?>housing" class="nav-link nav-toggle"> <i class="icon-home"></i> <span class="title">العقارات</span> </a>
						</li>
						<li class="nav-item  ">
							<a href="<?= AdminPanel; ?>project" class="nav-link nav-toggle"> <i class="fa fa-building"></i> <span class="title">المشاريع</span> </a>
						</li>
						<li class="nav-item  ">
							<a href="<?= AdminPanel; ?>blog" class="nav-link nav-toggle"> <i class="fa fa-newspaper-o"></i> <span class="title">المقالات</span> </a>
						</li>
						<li class="nav-item  ">
							<a href="<?= AdminPanel; ?>users" class="nav-link nav-toggle"> <i class="icon-users"></i> <span class="title">المستخدمين</span> </a>
						</li>
						<li class="nav-item  ">
							<a href="<?= AdminPanel; ?>cities" class="nav-link nav-toggle"> <i class="icon-diamond"></i> <span class="title"> المدن</span> </a>
						</li>
						<li class="nav-item  ">
							<a href="<?= AdminPanel; ?>housing_types" class="nav-link nav-toggle"> <i class="icon-layers"></i> <span class="title">أنواع العقارات</span> </a>
						</li>
						<li class="nav-item  ">
							<a href="<?= AdminPanel; ?>housing_additions" class="nav-link nav-toggle"> <i class="icon-wrench"></i> <span class="title">تفاصيل العقارات</span> </a>
						</li>
						<li class="nav-item  ">
							<a href="<?= AdminPanel; ?>contact" class="nav-link nav-toggle"> <i class="fa fa-comment"></i> <span class="title"> أستفسارات العقارات </span> </a>
						</li>
						<li class="nav-item  ">
							<a href="<?= AdminPanel; ?>contact/projects" class="nav-link nav-toggle"> <i class="fa fa-comment"></i> <span class="title"> أستفسارات المشاريع </span> </a>
						</li>
						<li class="nav-item  ">
							<a href="<?= AdminPanel; ?>main/slider" class="nav-link nav-toggle"> <i class="fa fa-image"></i> <span class="title"> الصور المتحركة  </span> </a>
						</li>
						<li class="nav-item  ">
							<a href="<?= AdminPanel; ?>settings" class="nav-link nav-toggle"> <i class="icon-social-dribbble"></i> <span class="title">عن التطبيق</span> </a>
						</li>
					</ul>
					<!-- END SIDEBAR MENU -->
					<!-- END SIDEBAR MENU -->
				</div>
				<!-- END SIDEBAR -->
			</div>
			<!-- END SIDEBAR -->
			<!-- BEGIN CONTENT -->
			<div class="page-content-wrapper">
				<!-- BEGIN CONTENT BODY -->
				<div class="page-content">
					<!-- BEGIN PAGE HEADER-->
					<!-- BEGIN PAGE BAR -->
					<div class="page-bar">
						<ul class="page-breadcrumb">
							<li> <a href="javascript:;">الرئيسية</a>
								<?php if ( !empty($breadcrumb) ){ ?>
									<i class="fa fa-circle"></i> </li>
									<li> <span> <?= $breadcrumb; ?></span> </li>
								<?php }else{ echo '</li>'; } ?>
						</ul>
					</div>
					<!-- END PAGE BAR -->
					<!-- BEGIN PAGE TITLE-->
					<h1 class="page-title"> <?php if ( !empty ($details) ) { echo $details; } ?> </h1>
					<!-- END PAGE TITLE-->
					<?php if (!empty ($addLink) ) { ?>
						<a href="<?= UrlPath . '/' . $addLink; ?>" class="btn red btn-lg addbutton"> إضافة <?php if( !empty( $addCategory ) ) echo $addCategory; ?> </a>
					<?php }?>	