<?php require (dirname(__FILE__) . '/../header.php') ?>
	<!--Start Header Section-->
	<div class="header">
		<div class="container">
			<div class="userfullname"> 
			<div class="text-center">
				<h1>أهلا <?= $_SESSION['username']?> ... </h1>
				<div class="layer">
					<h3>هنا تجد العقارات و المقالات المفضلة لديك  </h3>
				</div>
			</div>
			</div>
		</div>
	</div>
	<!--End Header Section-->
	<div class="row" style="width: 60%;margin-right: 20%;">
		<ul class="nav navtab-fav nav-tabs">
			<li class="navfav col-sm-4 active"><a data-toggle="tab" href="#menu1">العقارات</a></li>
			<li class="navfav col-sm-4 "><a data-toggle="tab" href="#menu2">السياحة</a></li>
			<li class="navfav col-sm-4 "><a data-toggle="tab" href="#menu3">التجارة و الأعمال </a></li>
		</ul>
	</div>
	<div class="tab-content">
		<!--Start Buildings Section-->
		<div id="menu1" class="buildings tab-pane fade in active">
			<div class="container">
				<?php if (!empty($housing)) { foreach ( $housing as $house ) : ?>
					<div class="home col-sm-4 col-xs-12">
						<div class="card">
							<div class="img"> <img src="<?= IMG ?>thumbs/<?= $house['pic'] ?>" /> </div>
							<div class="details">
								<p class="price"> <span class="number"><?= number_format($house['price']) ?> </span>ريال سعودي </p>
								<p class="description"><span class="type"> <?= (@$house['tpy'])?$house['tpy']:$house['type']; ?> </span> -
									<?= $house['title'] ?>
								</p>
								<div class="address">
									<div class="icon col-xs-1"> <img src="<?= FrontEndUrl ?>assets/images/icons/location%20brown%20.svg" /> </div>
									<div class="addr col-xs-11"> 
                                        <address><?= $house['address'] ?> <a target="_blank" href="https://www.google.com/maps/?q=<?=$house['lat'] ?>,<?=$house['lang'] ?>" class="show">(عرض على الخريطة)</a> </address> 
                                    </div>
								</div> <a href="<?= BaseUrl ?>housing/details/<?= $house['id'] ?>" class="readMore btn btn-primary center-block">تفاصيل أكثر</a> 
							</div>
						</div>
					</div>
				<?php endforeach; }else{ ?>
					<div class="row">
						<div class="text-center">
							<img src="<?= FrontEndUrl ?>assets/images/icons/face.svg">
							<h3> لا توجد عقارات مفضلة</h3>
						</div>
					</div>
				<?php } ?>	
			</div>
		</div>
		<!--End Buildings Section-->
		<!--Start Tourism Cards Section-->
		<div id="menu2" class="buildings tab-pane fade ">
			<div class="container">
				<?php if ( !empty($tourisms) ) { foreach ( $tourisms as $tourism ) : ?>
					<div class="home col-sm-4 col-xs-12">
						<div class="card blogcard">
							<div class="img"> <img src="<?= IMG ?>thumbs/<?= $tourism['pic'] ?>" /> </div>
							<div class="details">
								<p class="description">
									<?= $tourism['title'] ?>
								</p>
							</div> <a href="<?= BaseUrl ?>blogs/news/<?= $tourism['id'] ?>" class="readMore btn btn-primary center-block">تفاصيل أكثر</a> </div>
					</div>
				<?php endforeach; }else{ ?>
					<div class="row">
						<div class="text-center">
							<img src="<?= FrontEndUrl ?>assets/images/icons/face.svg">
							<h3> لا توجد مقالات مفضلة</h3>
						</div>
					</div>
				<?php } ?>	
			</div>
		</div>
		<!--End Tourism Cards Section-->
		<!--Start Business Cards Section-->
		<div id="menu3" class="buildings tab-pane fade ">
			<div class="container">
				<?php if ( !empty($business) ) { foreach ( $business as $bus ) : ?>
					<div class="home col-sm-4 col-xs-12">
						<div class="card blogcard">
							<div class="img"> <img src="<?= IMG ?>thumbs/<?= $bus['pic'] ?>" /> </div>
							<div class="details">
								<p class="description">
									<?= $bus['title'] ?>
								</p>
							</div> <a href="<?= BaseUrl ?>blogs/news/<?= $bus['id'] ?>" class="readMore btn btn-primary center-block">تفاصيل أكثر</a> </div>
					</div>
				<?php endforeach; }else{ ?>
					<div class="row">
						<div class="text-center">
							<img src="<?= FrontEndUrl ?>assets/images/icons/face.svg">
							<h3> لا توجد مقالات مفضلة</h3>
						</div>
					</div>
				<?php } ?>	
			</div>
		</div>
		<!--End Business Cards Section-->
	</div>
<?php require (dirname(__FILE__) . '/../footer.php') ?>