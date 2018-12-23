<?php require (dirname(__FILE__) . '/../header.php') ?>
	<!-- END PAGE HEADER-->
	<div class="tab-pane" id="tab_2">
		<div class="portlet box yellow">
			<div class="portlet-title">
			<div class="caption"> <i class="fa fa-gift"></i>عرض تفاصيل المشروع </div>
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
									<label class="control-label col-md-3">أسم المشروع :</label>
									<div class="col-md-9">
										<p class="form-control-static"> <?= $project['title']?> </p>
								    </div>
								</div>
							</div>
							<!--/span-->
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-md-3">العنوان :</label>
									<div class="col-md-9">
										<p class="form-control-static"> <?= $project['address']?>  </p>
									</div>
								</div>
							</div>
							<!--/span-->
						</div>
						<!--/row-->
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-md-3">المرحلة الحالية :</label>
									<div class="col-md-9">
										<p class="form-control-static"> <?= $project['current_phase']?> </p>
									</div>
								</div>
							</div>
							<!--/span-->
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-md-3">التفاصيل :</label>
									<div class="col-md-9">
										<?= $project['details']?> 
									</div>
								</div>
							</div>
							<!--/span-->
						</div>
						<!--/row-->
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-md-3">صورة رئيسية</label>
									<div class="col-md-9">
										<div class="fileinput fileinput-new" data-provides="fileinput">
											<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
											<?php if ( !empty($project['pic'])) : ?> 
												<img src="<?= IMG . 'files/' . $project['pic'] ?>" class="img-thumbnail" alt="<?= $project['title']?>" width="315" height="236">
											<?php else : ?>
												<img src="<?= BackEndUrl ?>assets/global/img/no-image.png" alt="" />
											<?php endif; ?>	 
											</div>
										</div>
									</div>
								</div>
							</div>
							<!--/span-->
						</div>
						<h3 class="form-section">الخريطة</h3>
						<!--/row-->
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-md-3">خط طول :</label>
									<div class="col-md-9">
										<p class="form-control-static"><?= $project['lang']?> </p>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-md-3">خط عرض :</label>
									<div class="col-md-9">
										<p class="form-control-static">  <?= $project['lat']?> </p>
									</div>
								</div>
							</div>
							<div class="row"> 
						      <div class="col-md-10" style="margin-right: 5%;">
							    <iframe width="100%" height="546" frameborder="0" style="border:0" 
										src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDz4OqjXzrGL1OnVjohiMb9hWGyjK01BZQ&q=<?=$project['lat']?>,<?=$project['lang']?>&language=en&zoom=12" allowfullscreen> 
								</iframe>
							   </div>
						      </div>
						</div>
						<h3 class="form-section">صور المشروع</h3>
							<div class="row">
								<div class="container">
								<?php if ($images) foreach ( $images as $img ) : ?>
										<div class="col-md-3">
											<li class="span4" style="list-style: none;">
												<div class="thumbnail"> 
												<form action="<?= AdminPanel . 'project/delimg/'. $img['id'] ?>" method="post" style="display: inline;position: absolute;"> 
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
					</div>
				  </div>
				<!-- END FORM-->
			</div>
		</div>
	</div>

<?php require (dirname(__FILE__) . '/../footer.php') ?>