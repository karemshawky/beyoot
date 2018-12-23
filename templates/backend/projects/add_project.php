<?php require (dirname(__FILE__) . '/../header.php') ?>
	<!-- END PAGE HEADER-->
	<div class="tab-pane" id="tab_2">
		<div class="portlet box green">
			<div class="portlet-title">
				<div class="caption"> <i class="fa fa-plus-circle"></i>إضافة مشروع </div>
				<div class="tools">
					<a href="javascript:;" class="collapse"> </a>
					<a href="javascript:;" class="fullscreen"> </a>
				</div>
			</div>
			<div class="portlet-body form">
				<!-- BEGIN FORM-->
				<form action="<?= BaseUrl ?>admin-panel/project/save" method="post" class="form-horizontal" enctype="multipart/form-data">
					<div class="form-body">
						<h3 class="form-section">التفاصيل</h3>
						<div class="row">
							<div class="col-md-6">
							<?php if ( !empty( $errTitle ) ) : ?>
								<div class="form-group has-error">
							<?php else : ?>	
								<div class="form-group ">
							<?php endif; ?>	
									<label class="control-label col-md-3">أسم المشروع </label>
									<div class="col-md-9">
										<input type="text" name="title" class="form-control" id="inputError" required placeholder="">
										<?php if ( !empty( $errTitle ) ) : ?>
											<span class="help-block"><?= $errTitle; ?> </span>
										<?php endif; ?>	
								    </div>
								</div>
							</div>
							<!--/span-->
							<div class="col-md-6">
							<?php if ( !empty( $errAddress ) ) : ?>
								<div class="form-group has-error">
							<?php else : ?>	
								<div class="form-group ">
							<?php endif; ?>	
									<label class="control-label col-md-3">العنوان</label>
									<div class="col-md-9">
										<input type="text" name="address" class="form-control" id="inputError" required placeholder="">
										<?php if ( !empty( $errAddress ) ) : ?>
											<span class="help-block"><?= $errAddress; ?> </span>
										<?php endif; ?>	
									</div>
								</div>
							</div>
							<!--/span-->
						</div>
						<!--/row-->
						<div class="row">
							<div class="col-md-6">
							<?php if ( !empty( $errPhase ) ) : ?>
								<div class="form-group has-error">
							<?php else : ?>	
								<div class="form-group ">
							<?php endif; ?>	
									<label class="control-label col-md-3">المرحلة الحالية</label>
									<div class="col-md-9">
										<input type="text" name="current_phase" class="form-control" id="inputError" required placeholder="">
										<?php if ( !empty( $errPhase ) ) : ?>
											<span class="help-block"><?= $errPhase; ?> </span>
										<?php endif; ?>	
									</div>
								</div>
							</div>
							<!--/span-->
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-md-3">صورة رئيسية</label>
									<div class="col-md-9">
										<div class="fileinput fileinput-new" data-provides="fileinput">
											<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;"> 
                                                <img src="<?= BackEndUrl ?>assets/global/img/no-image.png" alt="" /> </div>
											<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
											<div> 
                                                <span class="btn default btn-file">
                                                <span class="fileinput-new"> أختر صورة </span> <span class="fileinput-exists"> تغيير </span>
                                                <input type="file" name="upload" id="imgz" required> </span> <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> حذف </a>
                                            </div>
											<?php if ( !empty( $picerr ) ) : ?>															
											<div class="row">
												<br> <span class="help-block"> <?= $picerr ?> </span>					
											</div> 
											<?php endif; ?> 
										</div>
									</div>
								</div>
							</div>
							<!--/span-->
						</div>
						<!--/row-->
						<div class="row">
						    <div class="col-md-6">
								<div class="form-group ">
									<label class="control-label col-md-3">التفاصيل </label>
									<div class="col-md-9">
										<textarea type="text" name="details" class="form-control" placeholder=""></textarea>
									 </div>
								</div>
							</div>
							<!--/span-->
						</div>
						<h3 class="form-section">الخريطة</h3>
						<!--/row-->
						<div class="row">
							<div class="col-md-6">
								<?php if ( !empty( $errLang ) ) : ?>
								<div class="form-group has-error">
								<?php else : ?>	
								<div class="form-group ">
								<?php endif; ?>	
									<label class="control-label col-md-3">خط طول</label>
									<div class="col-md-9">
									<input type="text" name="lang" id="lng" class="form-control " onClick="" placeholder="55.326412895414">
										<?php if ( !empty( $errLang ) ) : ?>															
										<div class="row">
											<br> <span class="help-block"> <?= $errLang ?> </span>					
										</div> 
										<?php endif; ?>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<?php if ( !empty( $errLat ) ) : ?>
								<div class="form-group has-error">
								<?php else : ?>	
								<div class="form-group ">
								<?php endif; ?>	
									<label class="control-label col-md-3">خط عرض</label>
									<div class="col-md-9">
									<input type="text" id="lat" class="form-control " onClick="" name="lat" placeholder="51.326499898814">
										<?php if ( !empty( $errLat ) ) : ?>															
										<div class="row">
											<br> <span class="help-block"> <?= $errLat ?> </span>					
										</div> 
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div>
						<div class="row"> 
						  <div class="col-md-10" style="margin-right: 5%;">
							<div id="global">
								<div id="map" onClick="document.getElementById('lat').value=getCurrentLat();document.getElementById('lng').value=getCurrentLng();">
									<?= $map; ?>
								</div>
							</div>
						  </div>
						</div>
					</div>
					<div class="form-actions">
						<div class="row">
							<div class="col-md-6">
								<div class="row">
									<div class="col-md-offset-3 col-md-9">
										<button type="submit" class="btn green">حفظ</button>
										<a href="<?= AdminPanel .'project'?>" class="btn default">رجوع</a>
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