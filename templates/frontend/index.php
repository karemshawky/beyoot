<?php require (dirname(__FILE__) . '/header.php') ?>
    <!--Start Slider Section-->
    <div class="slider">
        <div class="mainSlider">
    <?php if ( !empty( $sliders ) ) { foreach ( $sliders as $slider ) : ?>
            <div class="img " style="background: url('<?= IMG ?>slider/<?= $slider['pic']?>') no-repeat center center  ; background-size: cover;width : 100%">
                <div class="layer"></div>
                <p class="<?= ( $slider['position_en'] ) ? $slider['position_en'] : 'bottom-right'; ?>"> <?= ( $slider['title'] ) ? $slider['title'] : 'أفضل العقارات لاستثمار أفضل
                    في أجمل مدن البوسنة'; ?> </p>
            </div>
    <?php endforeach; }else{ ?>
        <div class="img img1" style="background: url('<?= FrontEndUrl ?>assets/images/travel massive kosovo_0.jpg') no-repeat center center  ; background-size: cover;width : 100%">
                <div class="layer"></div>
                <p class="bottom-right">أفضل العقارات لاستثمار أفضل
                    في أجمل مدن البوسنة</p>
            </div>
            <div class="img img2" style="background: url('<?= FrontEndUrl ?>assets/images/reference-montazne-kuce-privatnakuca2.jpg') no-repeat center center  ; background-size: cover;width : 100%">
                <div class="layer"></div>
                <p class="bottom-right">أفضل العقارات لاستثمار أفضل
                    في أجمل مدن البوسنة 2</p>
            </div>
            <div class="img img3" style="background: url('<?= FrontEndUrl ?>assets/images/Zgrada.jpg') no-repeat center center  ; background-size: cover;width : 100%">
                <div class="layer"></div>
                <p class="bottom-right">أفضل العقارات لاستثمار أفضل
 3                    في أجمل مدن البوسنة</p>
            </div>
    <?php } ?>    
            
        </div>
    </div>
    <!--End Slider Section-->
    <!--Start Options Section-->
    <div class="options" id="options">
        <div class="container">
            <div class="row">
                <div class="option col-sm-4 col-xs-12">
                    <a href="<?= BaseUrl ?>projects">
                        <div class="icon center-block">
                            <img src="<?= FrontEndUrl ?>assets/images/icons/investment.svg">
                        </div>
                        <div class="text">
                            <p>استثمار</p>
                        </div>
                    </a>
                </div>
                <div class="option col-sm-4 col-xs-12">
                    <a href="<?= BaseUrl ?>blogs/tourism">
                        <div class="icon center-block">
                            <img src="<?= FrontEndUrl ?>assets/images/icons/tourism.svg">
                        </div>
                        <div class="text">
                            <p>ترفيه وسياحة</p>
                        </div>
                    </a>
                </div>
                <div class="option col-sm-4 col-xs-12">
                    <a href="<?= BaseUrl ?>blogs/business">
                        <div class="icon center-block">
                            <img src="<?= FrontEndUrl ?>assets/images/icons/business.svg">
                        </div>
                        <div class="text">
                            <p>تجارة وأعمال</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!--End Options Section-->
    <!--Start Buildings Section-->
    <div class="buildings">
        <div class="container">
        <?php if ($houses) foreach ( $houses as $house ) : ?>
            <div class="home col-sm-4 col-xs-12">
                <div class="card">
                    <div class="img">
                        <img src="<?= IMG ?>thumbs/<?= $house['pic'] ?>" />
                    </div>
                    <div class="details">
                        <p class="price">
                            <span class="number"><?= number_format($house['price']) ?> </span>ريال سعودي
                        </p>
                        <p class="description"><span class="type"> <?= $house['tpy'] ?> </span> - <?= $house['title'] ?> </p>
                        <div class="address">
                            <div class="icon col-xs-1">
                                <img src="<?= FrontEndUrl ?>assets/images/icons/location%20brown%20.svg" />
                            </div>
                            <div class="addr col-xs-11">
                                <address><?= $house['address'] ?> <a target="_blank" href="https://www.google.com/maps/?q=<?=$house['lat'] ?>,<?=$house['lang'] ?>" class="show">(عرض على الخريطة)</a> </address>
                            </div>
                        </div>
                        <a href="<?= BaseUrl ?>housing/details/<?= $house['id'] ?>" class="readMore btn btn-primary center-block">تفاصيل أكثر</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
    </div>
    <!--End Buildings Section-->
    <!--Start Video Section-->
    <?php if ( !empty($settings['video']) ) : ?>
    <div class="video">
        <iframe width="100%" height="410px" src="<?= ( $settings['video'] )? $settings['video'] : 'https://www.youtube.com/'; ?>?enablejsapi=1&amp;rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" encrypted-media=" allowfullscreen" id="autoplay-video"></iframe>
    </div>
    <?php endif;?>
    <!--End Video Section-->
    <!--Start Contact Section-->
    <div class="contact">
        <div class="invest">
            <div class="layer"></div>
            <p class="center-block">مستثمر ؟ وتود الاستثمار مع بيوت
                في المشاريع الحالية أو المستقبلية؟</p>
            <a class="readMore btn center-block" data-toggle="modal" data-target="#squarespaceModal">تواصل معنا</a>
				<!-- Modal -->
				<div class="modal fade" id="squarespaceModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal"><img aria-hidden="true" src="<?= FrontEndUrl ?>assets/images/icons/close%20.svg"> <span class="sr-only">Close</span></button>
							</div>
							<div class="modal-body form">
								<!-- content goes here -->
								<p class="sendText">أرسل لنا بياناتك وسيتم التواصل معكم لتنسيق استثماركم مع بيوت</p>
								<div class="row">
									<?php  if (empty($_SESSION['token'])) {
                                            $_SESSION['token'] = base64_encode(openssl_random_pseudo_bytes(32)); }
                                            $token = $_SESSION['token']; ?>
										<form action="#" method="post">
											<div class="form-group name col-xs-6">
												<input type="text" name="name" id="name" class="form-control" required="required" placeholder="الاسم"> </div>
											<div class="form-group number col-xs-6">
												<input type="text" name="phone" id="phone" class="form-control" required="required" placeholder="رقم الجوال"> </div>
											<div class="form-group col-xs-12">
												<input type="email" name="email" id="email" class="form-control" required="required" placeholder="البريد الإلكترونى"> </div>
											<div class="form-group col-xs-12">
												<textarea class="form-control" name="details" id="details" required="required" placeholder="ملاحظات" rows="5"></textarea>
											</div>
											<div class="form-group col-xs-12">
												<input type="hidden" name="token" value="<?= $token ?>">
												<input type="hidden" name="type_id" value="2">
												<input type="hidden" name="housing_id" value="0">
												<button id="formcontact" type="submit" class="col-xs-12 sendForm">أرسل</button>
											</div>
										</form>
								</div>
							</div>
							<div class="modal-body success hide">
								<!-- Successful Message -->
                                <img src="<?= FrontEndUrl ?>assets/images/icons/face.svg" style="margin-right: 35%;">
								<p class="successMsg center-block">شكراً .. تم إرسال بياناتكم للإدارة وسيتم التواصل معكم في أقرب وقت</p>
							</div>
						</div>
					</div>
				</div>
        </div>
    </div>
    <!--End Contact Section-->
    <!--Start Downlaod Section-->
    <div class="download">
        <img class="theme" src="<?= FrontEndUrl ?>assets/images/icons/theme.svg" />
        <h3 class="text-center">حمل الآن تطبيق بيوت </h3>
        <div class="icons">
            <a href="<?= $settings['ios'] ?>">
                <img class="appStore center-block text-center" src="<?= FrontEndUrl ?>assets/images/icons/app-store.png">
            </a>
            <a href="<?= $settings['andriod'] ?>">
                <img class="android center-block text-center" src="<?= FrontEndUrl ?>assets/images/icons/google-play.png">
            </a>
        </div>
        <img class="theme" src="<?= FrontEndUrl ?>assets/images/icons/theme.svg">
    </div>
    <!--End Download Section-->
<?php require (dirname(__FILE__) . '/footer.php') ?>