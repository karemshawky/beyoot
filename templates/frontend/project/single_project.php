<?php require (dirname(__FILE__) . '/../header.php');?>
	<!--Start Header Section-->
	<div class="header">
		<div class="container">
			<div class="projectsHeader text-center">
				<h2>مشاريعنا/  <?=$project['title'] ?></h2>
				<div class="layer">
					<p>إذا كنت مستثمر وتود مشاركة بيوت في مشاريعها الحالية أو المستقبلية</p>
				</div> 
			</div>
		</div>
	</div>
	<!--End Header Section-->
	<!--Start Details Slider Section-->
	<div class="deatailsSlider">
		<div class="container">
			<div class="projectDetails">
				<?php if ( $images ) foreach ( $images as $img ) : ?>
					<div class="img"> <img src="<?= BaseUrl ?>uploads/img/thumbs/<?= $img['link'] ?>" /> </div>
					<?php endforeach; ?>
			</div>
		</div>
	</div>
	<!--End Details Slider Section-->
	<!--Start All Details Section-->
	<div class="allDetails">
		<div class="container">
			<div class="row">
				<div class="container">
					<div class="basicDtails col-sm-9">
						<h3 class="projName"> <?=$project['title']?> </h3><br>
						<div class="address">
							<div class="icon col-xs-1"> <img src="<?= FrontEndUrl ?>assets/images/icons/location%20brown%20.svg" /> </div>
							<div class="addr col-xs-11"> 
                                <address> <?=$project['address'] ?> <a target="_blank" href="https://www.google.com/maps/?q=<?=$project['lat'] ?>,<?=$project['lang'] ?>" class="show">(عرض على الخريطة)</a></address> 
                            </div>
						</div>
						<h2 class="projDetails">تفاصيل المشروع</h2><br>
						<?= $project['details'] ?>
					</div>
					<div class="stage col-sm-3 col-xs-12">
						<h2 class="projStatus">المرحلة الحالية للمشروع</h2>
						<p> <?= $project['current_phase'] ?> </p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<br>
	<br>
	<br>
	<!--End All Details Section-->
	<?php require (dirname(__FILE__) . '/../footer.php') ?>