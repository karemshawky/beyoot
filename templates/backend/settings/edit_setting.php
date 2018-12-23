<?php require (dirname(__FILE__) . '/../header.php') ?>
	<!-- END PAGE HEADER-->
	<div class="tab-pane" id="tab_2">
		<div class="portlet box red">
			<div class="portlet-title">
				<div class="caption"> <i class="fa fa-pencil"></i>تعديل معلومات التطبيق </div>
				<div class="tools">
					<a href="javascript:;" class="collapse"> </a>
					<a href="javascript:;" class="fullscreen"> </a>
				</div>
			</div>
			<div class="portlet-body form">
				<!-- BEGIN FORM-->
				<form action="<?= BaseUrl ?>admin-panel/settings/update/1" method="post" class="form-horizontal">
					<input type="hidden" name="_METHOD" value="PUT"/>	
					<div class="form-body">
						<h3 class="form-section">التفاصيل</h3> 
						<div class="row">
							<div class="col-md-6">
								<div class="form-group ">
									<label class="control-label col-md-3">الهاتف </label>
									<div class="col-md-9">
										<input type="text" name="phone" value="<?= $settings['phone'] ?>" class="form-control" id="inputError">
								    </div>
								</div>
							</div>
							<!--/span-->
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group ">
									<label class="control-label col-md-3">Facebook </label>
									<div class="col-md-9">
										<input type="text" name="facebook" value="<?= $settings['facebook'] ?>" class="form-control" id="inputError">
								    </div>
								</div>
							</div>
							<!--/span-->
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group ">
									<label class="control-label col-md-3">Twitter </label>
									<div class="col-md-9">
										<input type="text" name="twitter" value="<?= $settings['twitter'] ?>" class="form-control" id="inputError">
								    </div>
								</div>
							</div>
							<!--/span-->
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group ">
									<label class="control-label col-md-3">Instagram </label>
									<div class="col-md-9">
										<input type="text" name="instagram" value="<?= $settings['instagram'] ?>" class="form-control" id="inputError">
								    </div>
								</div>
							</div>
							<!--/span-->
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group ">
									<label class="control-label col-md-3">Youtube </label>
									<div class="col-md-9">
										<input type="text" name="youtube" value="<?= $settings['youtube'] ?>" class="form-control" id="inputError">
								    </div>
								</div>
							</div>
							<!--/span-->
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group ">
									<label class="control-label col-md-3">Andriod </label>
									<div class="col-md-9">
										<input type="text" name="andriod" value="<?= $settings['andriod'] ?>" class="form-control" id="inputError">
								    </div>
								</div>
							</div>
							<!--/span-->
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group ">
									<label class="control-label col-md-3">IOS </label>
									<div class="col-md-9">
										<input type="text" name="ios" value="<?= $settings['ios'] ?>" class="form-control" id="inputError">
								    </div>
								</div>
							</div>
							<!--/span-->
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group ">
									<label class="control-label col-md-3">فيديو </label>
									<div class="col-md-9">
										<input type="text" name="ios" value="<?= $settings['video'] ?>" class="form-control" id="inputError">
								    </div>
								</div>
							</div>
							<!--/span-->
						</div>
					</div>
					<div class="form-actions">
						<div class="row">
							<div class="col-md-6">
								<div class="row">
									<div class="col-md-offset-3 col-md-9">
										<button type="submit" class="btn red">تعديل</button>
										<a href="<?= AdminPanel . 'settings' ?>" class="btn default">رجوع</a>
									</div>
								</div>
							</div>
							<div class="col-md-6"> </div>
						</div>
					</div>
				</form>
				<!-- END FORM-->
			</div>
		</div>
	</div>
<?php require (dirname(__FILE__) . '/../footer.php') ?>