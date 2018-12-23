<?php require (dirname(__FILE__) . '/../header.php') ?>
	<!--Start Property Details Slider Section-->
	<div class="propDetailsSlider">
		<div class="container">
			<div class="row">
				<div class="col-sm-8">
					<div class="propSlider">
						<?php if ( $house['images'] ) foreach ( $house['images'] as $img ) : ?>
							<div class="img"> <img src="<?= IMG ?>thumbs/<?= $img['link'] ?>" />
								<p>
									<?= $img['title'] ?>
								</p>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
				<div class="propContact col-sm-4">
					<div class="col-xs-12"> 
					<a href="tel:<?= ( $house['phone'] == 0 )? $house['app_phone']: $house['phone']; ?>" class="btn tel btn-primary btn-lg">
						<span class="phone hide"> <?= ( $house['phone'] == 0 )? $house['app_phone']: $house['phone']; ?></span>
						<span class="call"> <img src="<?= FrontEndUrl ?>assets/images/icons/Call.svg" /> &nbsp;إتصال</span></a> 
					</div>
					<div class="col-xs-12"> 
						<a data-toggle="modal" data-target="#squarespaceModal" class="btn msg btn-primary btn-lg">
						<img src="<?= FrontEndUrl ?>assets/images/icons/message.svg" />&nbsp;رسالة </a>
						<!-- Modal -->
						<div class="modal fade" id="squarespaceModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal"><img aria-hidden="true" src="<?= FrontEndUrl ?>assets/images/icons/close%20.svg"> <span class="sr-only">Close</span></button>
									</div>
									<div class="modal-body form">
										<!-- content goes here -->
										<p class="sendText">أرسل لنا بياناتك وسيتم التواصل معكم في أقرب وقت</p>
										<div class="row">
											<?php  if (empty($_SESSION['token'])) {
                                            		$_SESSION['token'] = base64_encode(openssl_random_pseudo_bytes(32)); }
                                            		$token = $_SESSION['token']; ?>
												<form action="#" method="post" class="formz">
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
														<input type="hidden" id="typid" name="type_id" value="1">
														<input type="hidden" id="husid" name="housing_id" value="<?= $house['id'] ?>">
														<button id="formcontact" type="submit" class="col-xs-12 sendForm">أرسل</button>
													</div>
												</form>
											</div>
										</div>
										<div class="modal-body success hide">
											<!-- Successful Message -->
											<img src="<?= FrontEndUrl ?>assets/images/icons/face.svg" style="margin-right: 200px;">
											<p class="successMsg center-block">شكراً .. تم إرسال بياناتكم للإدارة وسيتم التواصل معكم في أقرب وقت</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--End Property Details Slider Section-->
		   <!--Start Prperty Details Section-->
		<div class="propertyDetails">
			<div class="container">
				<div class="row">
					<div class="col-sm-8 col-xs-12">
						<div class="details col-xs-12 col-sm-8">
							<p class="price"> <span class="number"><?= number_format($house['price']) ?> </span>ريال سعودي </p>
							<p class="description"><span class="type"> <?= $house['type']; ?> </span> -
								<?= $house['title'] ?>
							</p>
							<div class="address">
								<div class="icon col-xs-1"> <img src="<?= FrontEndUrl ?>assets/images/icons/location%20brown%20.svg" /> </div>
								<div class="addr col-xs-11"> <address> <?= $house['address'] ?> <a target="_blank" href="https://www.google.com/maps/?q=<?=$house['lat'] ?>,<?=$house['lang'] ?>" class="show">(عرض على الخريطة)</a> </address> </div>
							</div>
						</div>
						<div class="options col-sm-3 col-xs-12"> 
							<a href="<?= ($house['video'] == '0' )?'#':$house['video']; ?>" target="_blank"><img src="<?= FrontEndUrl ?>assets/images/icons/video.svg" /></a> 
							<a class="cnt" href="#panoq"><img src="<?= FrontEndUrl ?>assets/images/icons/360.svg "></a>
							<?php if ( $_SESSION['userid'] && $house['is_fav'] == 1 ) { ?> 
								<form action="<?= BaseUrl ?>user/delfav" method="post" style="display: inline;position: absolute;margin-right: 5px;">
                                    <input type="hidden" name="_METHOD" value="DELETE"/>
									<input type="hidden" name="type_id" value="1">
									<input type="hidden" name="number_id" value="<?= $house['id'] ?>"> 
                                    <input type="image" src="<?= FrontEndUrl ?>assets/images/star2.png" alt="حذف" data-toggle="tooltip" title=" حذف"/>
                                </form>
							<?php } if( $_SESSION['userid'] && $house['is_fav'] == 0 ) { ?> 
								<form action="<?= BaseUrl ?>user/addfav" method="post" style="display: inline;position: absolute;margin-right: 5px;">
									<input type="hidden" name="type_id" value="1">
									<input type="hidden" name="number_id" value="<?= $house['id'] ?>"> 
                                    <input type="image" src="<?= FrontEndUrl ?>assets/images/star1.png" alt="أضف" data-toggle="tooltip" title=" أضف"/>
                                </form>
							<?php } if( $_SESSION['userid'] == 0 ) { ?> 
								<a class="last notlogin" href="#"><img style="display: inline;position: absolute;margin-right: 5px;" src="<?= FrontEndUrl ?>assets/images/star1.png "></a>
							<?php } ?>	
						</div>
					</div>
					<div class="col-sm-8 col-xs-12 propTable">
						<h3>تفاصيل العقار </h3>
						<table class="table table-bordered">
							<tr>
								<td class="title">السعر</td>
								<td> <?= number_format($house['price']) ?> ريال سعودي </td>
							</tr>
							<tr>
								<td class="title">النوع</td>
								<td> <?=$house['type'] ?> </td>
							</tr>
							<tr>
								<td class="title">المساحة</td>
								<td> <?=$house['area'] ?> م٢ </td>
							</tr>
							<?php if ( !empty($house['additions']) ) { foreach ( $house['additions'] as $add ) :
                                  if ( $add['type_id'] == 2 ) : ?>
								<tr>
									<td class="title"> <?= $add['type'] ?> </td>
									<td> <?= $add['value'] ?> </td>
								</tr>
							<?php elseif ( $add['type_id'] == 1 ) : ?>
									<tr>
										<td class="title"> <?= $add['type'] ?> </td>
										<td> <?= ($add['value'] == 1) ? '&#10004;': '&#10006;' ; ?> </td>
									</tr>
							<?php endif; endforeach; }else{}?>
						</table>
					</div>
					<div class="propDescription col-sm-8 col-xs-12">
						<h3>وصف العقار </h3>
						<div class="card"> <?=$house['description'] ?> </div>
					</div>
					<div class="location col-sm-8 col-xs-12">
						<h3>موقع العقار على الخريطة</h3>
						<iframe width="100%" height="546" frameborder="0" style="border:0" 
								src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDz4OqjXzrGL1OnVjohiMb9hWGyjK01BZQ&q=<?=$house['lat']?>,<?=$house['lang']?>&language=en&zoom=12" allowfullscreen> 
						</iframe>
					</div>
					<div class="col-sm-8 col-xs-12" id="panoq">
						<h3> صور 360 درجة </h3>
					<?php if ( $house['360_degree'] == 0 ) { $pano = 'no_image.png'; }else{ $pano = $house['360_degree'];} ?>
						<div id="content">
							<div id="360_container"></div>
							<input id="data" type="hidden" name="country" value="<?= IMG . '360/' . $pano ?>"> 
						</div>
					</div>
					<div class="review col-sm-8 col-xs-12">
						<p class="text-center first">هل أعجبك العقار ؟</p>
						<p class="text-center">يمكنك الاستفسار أو طلب الشراء الآن</p>
						<div class="col-xs-6 propContact">
							<a href="tel:<?= ( $house['phone'] == 0 )? $house['app_phone']: $house['phone']; ?>" class="btn tel btn-primary btn-lg"> <span class="phone hide"><?= ( $house['phone'] == 0 )? $house['app_phone']: $house['phone']; ?></span><span class="call">
                            <img src="<?= FrontEndUrl ?>assets/images/icons/Call.svg" /> &nbsp;إتصال</span></a>
						</div>
						<div class="col-xs-6 propContact"> 
							<a data-toggle="modal" data-target="#squarespaceModal" class="btn msg btn-primary btn-lg">
								<img src="<?= FrontEndUrl ?>assets/images/icons/message.svg" />&nbsp;رسالة </a> 
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--End Property Details Section-->
<?php require (dirname(__FILE__) . '/../footer.php') ?>