<?php require (dirname(__FILE__) . '/../header.php') ?>
	<!-- END PAGE HEADER-->
	<div class="tabbable-line boxless tabbable-reversed">
		<div class="tab-pane" id="tab_3">
			<div class="portlet box yellow">
				<div class="portlet-title">
					<div class="caption"> <i class="fa fa-gift"></i>عرض العقار </div>
					<div class="tools">
						<a href="javascript:;" class="collapse"> </a>
						<a href="javascript:;" class="fullscreen"> </a>
					</div>
				</div>
				<div class="portlet-body form">
					<!-- BEGIN FORM-->
					<div class="form-horizontal">
						<div class="form-body">
							<h3 class="form-section">التفاصيل</h3>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-3">الأسم :</label>
										<div class="col-md-9">
											<p class="form-control-static">
												<?= $house['title'];?>
											</p>
										</div>
									</div>
								</div>
								<!--/span-->
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-3">التفاصيل :</label>
										<div class="col-md-9">
											<p class="form-control-static">
												<?= $house['description'];?>
											</p>
										</div>
									</div>
								</div>
								<!--/span-->
							</div>
							<!--/row-->
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-3">النوع :</label>
										<div class="col-md-9">
											<p class="form-control-static">
												<?= $type;?>
											</p>
										</div>
									</div>
								</div>
								<!--/span-->
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-3">المدينة :</label>
										<div class="col-md-9">
											<p class="form-control-static">
												<?= $city;?>
											</p>
										</div>
									</div>
								</div>
								<!--/span-->
							</div>
							<!--/row-->
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-3">السعر :</label>
										<div class="col-md-9">
											<p class="form-control-static">
												<?= $house['price'];?> ريال سعودى </p>
										</div>
									</div>
								</div>
								<!--/span-->
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-3">المساحة :</label>
										<div class="col-md-9">
											<p class="form-control-static">
												<?= $house['area'];?> م2 </p>
										</div>
									</div>
								</div>
								<!--/span-->
							</div>
							<!--/row-->
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-3">الهاتف :</label>
										<div class="col-md-9">
											<p class="form-control-static">
												<?= $house['phone'];?>
											</p>
										</div>
									</div>
								</div>
								<!--/span-->
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-3">العنوان :</label>
										<div class="col-md-9">
											<p class="form-control-static">
												<?= $house['address'];?>
											</p>
										</div>
									</div>
								</div>
								<!--/span-->
							</div>
							<!--/row-->
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-3">فيديو :</label>
										<div class="col-md-9">
											<p class="form-control-static">
												<?= $house['video'];?>
											</p>
										</div>
									</div>
								</div>
								<!--/span-->
							</div>
							<!--/row-->
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-3">صورة رئيسية :</label>
										<div class="col-md-9">
										  <div class="col-md-6">
										    <div class="thumbnail">
											<?php if ( $house['pic'] == '0' ) : ?> 
												<img src="<?= BackEndUrl ?>assets/global/img/no-image.png" alt="" />
											<?php else : ?>
												<img class="img-desc" src="<?= IMG .'files/'. $house['pic']; ?>"><br>
											<?php endif; ?>	
											</div>
										  </div>
										</div>
									</div>
								</div>
								<!--/span-->
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-3">صورة 360 :</label>
										<div class="col-md-9">
										  <div class="col-md-6">
										    <div class="thumbnail">
											<?php if ( $house['360_degree'] == '0' ) : ?> 
												<img src="<?= BackEndUrl ?>assets/global/img/no-image.png" alt="" />
											<?php else : ?>
												<img class="img-desc" src="<?= IMG .'360/'. $house['360_degree']; ?>"><br>
											<?php endif; ?>	 
											</div>
										  </div>
										</div>
									</div>
								</div>
								<!--/span-->
							</div>
							<!--/row-->
							<h3 class="form-section">الخريطة</h3>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-3">خط طول :</label>
										<div class="col-md-9">
											<p class="form-control-static" style="direction: ltr;">
												<?= $house['lang'];?>
											</p>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-3">خط عرض :</label>
										<div class="col-md-9">
											<p class="form-control-static" style="direction: ltr;">
												<?= $house['lat'];?>
											</p>
										</div>
									</div>
								</div>
							</div>
							<div class="row"> 
						      <div class="col-md-10" style="margin-right: 5%;">
							    <iframe width="100%" height="546" frameborder="0" style="border:0" 
										src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDz4OqjXzrGL1OnVjohiMb9hWGyjK01BZQ&q=<?=$house['lat']?>,<?=$house['lang']?>&language=en&zoom=12" allowfullscreen> 
								</iframe>
							   </div>
						      </div>
						    </div>
							<!--/row-->
							<h3 class="form-section">إضافات</h3>
							<div class="row">
							<?php foreach ( $additions as $adds ) : 
									if ( $adds['type_id'] == 1) : ?>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-3"> <?= $adds['tpy'] ?> :</label>
										<div class="col-md-9">
											<p class="form-control-static">
												<?php if ( $adds['type'] == 1 ) : ?> 
													<img src="<?= BackEndUrl; ?>assets/pics/checked.png" class="icnz" alt=""> 
												<?php else : ?>
													<img src="<?= BackEndUrl; ?>assets/pics/x.png" class="icnz" alt=""> 
												<?php endif; ?>
											</p>
										</div>
									</div>
								</div>
								<?php elseif ( $adds['type_id'] == 2 ) : ?>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-3"> <?= $adds['tpy'] ?> :</label>
										<div class="col-md-9">
											<p class="form-control-static"> <?= $adds['value'] ?></p>
										</div>
									</div>
								</div>
								<?php endif; endforeach; ?>
							</div>
							<!--/row-->
							<h3 class="form-section">صور العقار</h3>
							<div class="row">
								<div class="container">
								<?php if ($images) foreach ( $images as $img ) : ?>
										<div class="col-md-3">
											<li class="span4" style="list-style: none;">
												<div class="thumbnail"> 
												<form action="<?= AdminPanel . 'housing/delimg/'. $img['id'] ?>" method="post" style="display: inline;position: absolute;"> 
                                                        <input type="hidden" name="_METHOD" value="DELETE"/>
                                                        <input type="image" class="icnz" src="<?= BackEndUrl; ?>assets/pics/wrong.png" alt="أزالة" />
                                                </form>
												<img class="img-desc" src="<?= IMG .'files/'. $img['link']; ?>">
													<h4> <?= $img['title']; ?> </h4>
												</div>
											</li>
										</div>
								<?php endforeach; ?>		
								</div>
							</div>
							<h3 class="form-section">صور  360 درجة </h3>
							<div class="row">
								<div class="container">
								<?php if ($panorama) foreach ( $panorama as $img1 ) : ?>
										<div class="col-md-3">
											<li class="span4" style="list-style: none;">
												<div class="thumbnail"> 
												<form action="<?= AdminPanel . 'housing/delimg/'. $img1['id'] ?>" method="post" style="display: inline;position: absolute;"> 
                                                        <input type="hidden" name="_METHOD" value="DELETE"/>
                                                        <input type="image" class="icnz" src="<?= BackEndUrl; ?>assets/pics/wrong.png" alt="أزالة" />
                                                </form>
												<img class="img-desc" src="<?= IMG .'360/'. $img1['link']; ?>">
													<h4> <?= $img1['title']; ?> </h4>
												</div>
											</li>
										</div>
								<?php endforeach; ?>		
								</div>
							</div>
						</div>
					</div>
					<!-- END FORM-->
				</div>
			</div>
		</div>
	</div>
	<?php require (dirname(__FILE__) . '/../footer.php') ?>