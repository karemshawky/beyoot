<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>Bujut Dashboard</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
	    <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">
        <link href="<?= BackEndUrl ?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= BackEndUrl ?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= BackEndUrl ?>assets/global/plugins/bootstrap/css/bootstrap-rtl.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= BackEndUrl ?>assets/global/plugins/bootstrap-switch/css/bootstrap-switch-rtl.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="<?= BackEndUrl ?>assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= BackEndUrl ?>assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="<?= BackEndUrl ?>assets/global/css/components-rtl.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?= BackEndUrl ?>assets/global/css/plugins-rtl.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="<?= BackEndUrl ?>assets/pages/css/login-3-rtl.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="login/img/favicon.ico" />
    <!-- END HEAD -->
</head>
    <body class=" login">
        <!-- BEGIN LOGO -->
        <div class="logo">
            <a href="#">
                <img src="<?= BackEndUrl ?>assets/pic/logo255.png" width="280" height="170" alt="" /> </a>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN LOGIN -->
        <div class="content">
        <?php  if (empty($_SESSION['token'])) {
                    $_SESSION['token'] = base64_encode(openssl_random_pseudo_bytes(32));
               }
               $token = $_SESSION['token']; ?>
            <!-- BEGIN LOGIN FORM -->
            <form action="<?= htmlspecialchars ( AdminPanel .'login' ) ?>" method="post" class="form-horizontal">    
                <h3 class="form-title text-center">تسجيل الدخول إلى حسابك</h3>
                <?php if ( !empty($err) ) { ?>
                    <div class="form-group alert alert-danger" role="alert"> <?= $err; ?>  </div>
                <?php } ?>    
                <div class="form-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">Username</label>
                    <div class="input-icon">
                        <i class="fa fa-user"></i>
                        <input class="form-control placeholder-no-fix" type="text" required="required" autocomplete="off" placeholder="أسم المستخدم" name="name" /> </div>
                </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Password</label>
                    <div class="input-icon">
                        <i class="fa fa-lock"></i>
                        <input class="form-control placeholder-no-fix" type="password" required="required" autocomplete="off" placeholder="كلمة المرور" name="password" /> </div>
                </div>
                <!-- <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Role</label>
                  <select name="role" class="form-control rolz" id="role" required="required">
                      <option value="" disable> المهنة</option>
                        <option value="1"> مدير النظام</option>
                        <option value="2"> مسئول</option>
                  </select>
                </div> -->
                <div class="form-actions">
                    <label class="rememberme mt-checkbox mt-checkbox-outline">
                        <!-- <input type="checkbox" name="remember" value="1" /> Remember me
                        <span></span> -->
                    </label>
                    <input type="hidden" name="token" value="<?= $token ?>">
                    <button type="submit" class="btn btn-lg green pull-center"> دخول </button>
                </div>
                <!-- <div class="forget-password text-left">
                    <h4>هل نسيت كلمة المرور ؟ </h4>
                    <p> أضغط 
                        <a href="javascript:;" id="forget-password"> هنـــــا </a> لتحديث كلمة المرور </p>
                </div> -->
            </form>
            <!-- END LOGIN FORM -->
            <!-- BEGIN FORGOT PASSWORD FORM -->
            <!--<form action="#" method="post" class="form-horizontal">      
                  <h3>نسيت كلمة المرور ؟</h3>
                <p class="text-left"> أدخل البريد الالكترونى  </p>
                    <?php //=$this->session->flashdata('message');?>
                <div class="form-group">
                    <div class="input-icon">
                        <i class="fa fa-envelope"></i>
                        <input class="form-control placeholder-no-fix" type="email" required="required" autocomplete="off" placeholder="البريد الالكترونى" name="e_mail" /> </div>
                </div>
                <div class="form-actions">
                    <button type="button" id="back-btn" class="btn grey-salsa btn-outline"> رجوع </button>
                    <button type="submit" class="btn green pull-left"> تسجيل </button>
                </div>
            </form> -->
            <!-- END FORGOT PASSWORD FORM -->
        </div>
        <!-- END LOGIN -->
<!--[if lt IE 9]>
<script src="login/global/plugins/respond.min.js"></script>
<script src="login/global/plugins/excanvas.min.js"></script> 
<script src="login/global/plugins/ie8.fix.min.js"></script> 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="<?= BackEndUrl ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="<?= BackEndUrl ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?= BackEndUrl ?>assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="<?= BackEndUrl ?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="<?= BackEndUrl ?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="<?= BackEndUrl ?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?= BackEndUrl ?>assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="<?= BackEndUrl ?>assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
        <script src="<?= BackEndUrl ?>assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?= BackEndUrl ?>assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="<?= BackEndUrl ?>assets/pages/scripts/login.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <!-- END THEME LAYOUT SCRIPTS -->
    </body>
</html>