<?php require (dirname(__FILE__) . '/../header.php') ?>
	<!-- END PAGE HEADER-->
	<div class="tab-pane" id="tab_2">
		<div class="portlet box yellow">
			<div class="portlet-title">
			<div class="caption"> <i class="fa fa-gift"></i>عرض المقال </div>
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
								<div class="form-group ">
									<label class="control-label col-md-3">عنوان المقال :  </label>
									<div class="col-md-9">
										<p class="form-control-static"> <?= $blog['title']?> </p>
								    </div>
								</div>
							</div>
							<!--/span-->
							<div class="row">
							<div class="col-md-6">
								<div class="form-group">
								<label class="control-label col-md-3">القسم :</label>
									<div class="col-md-9">
										<p class="form-control-static"><?= ( $blog['type_id'] == 1 ) ? 'سياحة': 'أعمال'; ?> </p>
									</div>
								</div>
							</div>
							<!--/span-->
						</div>
						<!--/row-->
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-md-3">التفاصيل : </label>
									<div class="col-md-9">
										<div class="form-control-static"> <?= $blog['details']?> </div>
									 </div>
								</div>
							</div>
							<!--/span-->
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-md-3">صورة رئيسية : </label>
									<div class="col-md-9">
										<div class="fileinput fileinput-new" data-provides="fileinput">
											<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
											<?php if ( !empty($blog['pic'])) : ?> 
												<img src="<?= IMG . 'files/' . $blog['pic'] ?>" class="img-thumbnail" alt="<?= $blog['title']?>" width="315" height="236">
											<?php else : ?>
												<img src="<?= BackEndUrl ?>assets/global/img/no-image.png" alt="" />
											<?php endif; ?>	 
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--/row-->
					</div>	
				</div>
				<!-- END FORM-->
			</div>
		</div>
	</div>
<?php require (dirname(__FILE__) . '/../footer.php') ?>