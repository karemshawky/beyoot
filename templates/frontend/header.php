<!DOCTYPE html>
<html dir="rtl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Bujut - أفضل العقارات للاستثمار في أجمل مدن البوسنة</title>
    <link rel="icon" href="<?= FrontEndUrl ?>assets/images/Logo.svg" sizes="16x16">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="<?= FrontEndUrl ?>assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= FrontEndUrl ?>assets/css/bootstrap.rtl.min.css" />
    <link rel="stylesheet" href="<?= FrontEndUrl ?>assets/css/slick.css" />
    <link rel="stylesheet" href="<?= FrontEndUrl ?>assets/css/slick-theme.css"/>
    <link rel="stylesheet" href="<?= FrontEndUrl ?>assets/css/nice-select.css">
    <link rel="stylesheet" href="<?= FrontEndUrl ?>panaroma-mob/css/main2.css" />
    <link rel="stylesheet" href="<?= FrontEndUrl ?>assets/css/main.css" />
    <link rel="stylesheet" href="<?= FrontEndUrl ?>assets/css/firebase.css" />
    <link rel="stylesheet" href="<?= FrontEndUrl ?>assets/css/jquery-confirm.min.css">
  
  <script src="https://www.gstatic.com/firebasejs/4.3.1/firebase.js"></script>
  <script>
    // Initialize Firebase
    // for local version
    var config = {
        apiKey: "AIzaSyAtCRmcIUIju1LkaZN-1WzU6MlMBdcfvKs",
        authDomain: "buyut-1524596066471.firebaseapp.com",
        databaseURL: "https://buyut-1524596066471.firebaseio.com",
        projectId: "buyut-1524596066471",
        storageBucket: "buyut-1524596066471.appspot.com",
        messagingSenderId: "214415518250"
    };
    // for online version
    // var config = {
    //     apiKey: "AIzaSyB4Y6ePo9rPemR6wX7qrLd8jBUIbSNBZiE",
    //     authDomain: "buiut-8b95d.firebaseapp.com",
    //     databaseURL: "https://buiut-8b95d.firebaseio.com",
    //     projectId: "buiut-8b95d",
    //     storageBucket: "buiut-8b95d.appspot.com",
    //     messagingSenderId: "1046808084781"
    // };
    firebase.initializeApp(config);
    </script>
  <script src="https://www.gstatic.com/firebasejs/ui/2.7.0/firebase-ui-auth__ar.js"></script>
  <link type="text/css" rel="stylesheet" href="https://www.gstatic.com/firebasejs/ui/2.7.0/firebase-ui-auth-rtl.css" />

  </head>
  <body>
    <!--Start Login Section-->
    <div class="login">
          <div class="container">
                <div class="loginContainer pull-right hidden-xs">
                <?php if ( empty( $_SESSION['username'] ) ) : ?>
                <a data-toggle="modal" data-target="#loginModal" class="btn msg btn-lg"> 
                    <span>تسجيل دخول</span>&nbsp;
                    <img src="<?= FrontEndUrl ?>assets/images/icons/profile_round%20%5B%231342%5D.svg" /> 
                </a>
                <?php else: ?>
                <a href="<?= BaseUrl ?>user/fav" class="btn msg btn-lg"> 
                    <span> مفضلتى</span>&nbsp;
                    <img src="<?= FrontEndUrl ?>assets/images/icons/profile_round%20%5B%231342%5D.svg" /> 
                </a>
                <a href="<?= BaseUrl ?>user/logout" class="btn msg btn-lg"> 
                    <span> خروج</span>&nbsp;
                    <img src="<?= FrontEndUrl ?>assets/images/exit.png" /> 
                </a>
                <?php endif; ?>
            </div>
      </div>
    </div>
    <!--End Login Section-->
    <!--Start Navbar Section-->
    <div class="navbar">
            <nav class="navbar navbar-default">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse ss navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="first"><a class="cnt" href="#contact">تواصل معنا <span class="sr-only">(current)</span></a></li>
                        <li><a href="<?= BaseUrl ?>blogs/business">التجارة والأعمال</a></li>
                        <li><a href="<?= BaseUrl ?>blogs/tourism">السياحة</a></li>
                        <li><a href="<?= BaseUrl ?>projects">مشاريعنا</a></li>
                        <li><a href="<?= BaseUrl ?>housing">العقارات</a></li>
                        <li><a href="<?= BaseUrl ?>"> الرئيسية</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
                <a href="<?= BaseUrl ?>" > 
                    <img class="logo" src="<?= FrontEndUrl ?>assets/images/Logo.svg">
                </a>
            </div><!-- /.container-fluid -->
        </nav>
    </div>
    <!--End Navbar Section-->
    <!-- Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><img aria-hidden="true" src="<?= FrontEndUrl ?>assets/images/icons/close%20.svg"> <span class="sr-only">Close</span></button>
            </div>
            <div class="modal-body form">
                <!-- content goes here -->
                <div class="row text-center">
                    <img class="logo" src="<?= FrontEndUrl ?>assets/images/Logo.svg">
                </div><br>
                <p class="sendText">سجل ليمكنك حفظ هذا العقار فى مفضلتك  </p>                
                <div class="row">
                    <?php  if (empty($_SESSION['token'])) {
                            $_SESSION['token'] = base64_encode(openssl_random_pseudo_bytes(32)); }
                            $token = $_SESSION['token']; ?>
                    <form action="#" method="post" id="formRegy">
                        <div class="form-group name col-xs-6">
                            <input type="text" name="name" id="name" class="form-control" placeholder="الاسم"> </div>
                        <div class="form-group number col-xs-6">
                            <input type="text" name="phone" id="phone" class="form-control" placeholder="رقم الجوال 96000000000+"> </div>
                        <div class="form-group col-xs-12">
                            <input type="hidden" name="token" value="<?= $token ?>">
                            <button id="formReg" type="submit" class="col-xs-12 ">تسجيل </button>    <!-- sendRegister -->
                        </div>
                    </form>
                </div>
                    <p class="sendText"> لديك حساب بالفعل ؟ <a class="sendForm"> <strong style="color:#a95c3e;"> سجل دخول</strong> </a>   </p>             
                </div>

                <div class="modal-body success hide">
                    <div class="row text-center" style="margin-top:-90px;margin-right:31%;position: absolute;">
                        <img class="logo" src="<?= FrontEndUrl ?>assets/images/Logo.svg">
                    </div><br>
                    <div id="containerz">
                        <div id="loading">تحميل ... </div>
                        <div id="loaded" >
                            <div id="main">
                                <div id="user-signed-in" class="hiddenz">
                                    <div id="user-info">
                                        <div id="photo-container"> <img id="photo"> </div>
                                        <div id="name"></div>
                                        <div id="email"></div>
                                        <div id="phone"></div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div id="user-signed-out" class="hiddenz">
                                    <div id="firebaseui-spa">
                                        <div id="firebaseui-container"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><br>
                    <p class="sendText"> <a class="sendForm"> <strong style="color:#a95c3e;"> رجوع</strong> </a> </p>             
                </div>

        </div>
    </div>
</div>