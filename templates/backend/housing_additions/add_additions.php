<?php require (dirname(__FILE__) . '/../header.php') ?>
	<!-- END PAGE HEADER-->
	<div class="tab-pane" id="tab_2">
		<div class="portlet box green">
			<div class="portlet-title">
				<div class="caption"> <i class="fa fa-plus-circle"></i> إضافة تقاصيل للعقارات </div>
				<div class="tools">
					<a href="javascript:;" class="collapse"> </a>
					<a href="javascript:;" class="fullscreen"> </a>
				</div>
			</div>
			<div class="portlet-body form">
				<!-- BEGIN FORM-->
				<form action="<?= BaseUrl ?>admin-panel/housing_additions/save" method="post" class="form-horizontal">
					<div class="form-body">
						<h3 class="form-section">التفاصيل</h3> 
						<div class="row">
							<div class="col-md-6">
							<?php if ( !empty( $err ) ) : ?>
								<div class="form-group has-error">
							<?php else : ?>	
								<div class="form-group ">
							<?php endif; ?>	
									<label class="control-label col-md-3">الأسم </label>
									<div class="col-md-9">
										<input type="text" class="form-control" name="type" required id="inputError" placeholder="عدد غرف النوم">
										<?php if ( !empty( $err ) ) : ?>
											<span class="help-block"><?= $err; ?> </span>
										<?php endif; ?>	
								    </div>
								</div>
							</div>
							<!--/span-->
							<div class="col-md-6">
								<div class="form-group ">
									<label class="control-label col-md-3">النوع </label>
									<div class="col-md-9">
										<select class="form-control" name="type_id">
											<option value="1">غير رقمى</option>
											<option value="2">رقمى</option>
										</select> 
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
										<button type="submit" class="btn green">حفظ</button>
										<a href="<?= AdminPanel . 'housing_additions' ?>" class="btn default">رجوع</a>
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