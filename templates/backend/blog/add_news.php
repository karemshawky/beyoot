<?php require (dirname(__FILE__) . '/../header.php') ?>
	<!-- END PAGE HEADER-->
	<div class="tab-pane" id="tab_2">
		<div class="portlet box green">
			<div class="portlet-title">
				<div class="caption"> <i class="fa fa-plus-circle"></i>إضافة مقال </div>
				<div class="tools">
					<a href="javascript:;" class="collapse"> </a>
					<a href="javascript:;" class="fullscreen"> </a>
				</div>
			</div>
			<div class="portlet-body form">
				<!-- BEGIN FORM-->
				<form action="<?= BaseUrl ?>admin-panel/blog/save" method="post" class="form-horizontal" enctype="multipart/form-data">
					<div class="form-body">
						<h3 class="form-section">التفاصيل</h3>  
						<div class="row">
							<div class="col-md-6">
							<?php if ( !empty( $err ) ) : ?>
								<div class="form-group has-error">
							<?php else : ?>	
								<div class="form-group ">
							<?php endif; ?>	
									<label class="control-label col-md-3">عنوان المقال </label>
									<div class="col-md-9">
										<input type="text" class="form-control" name="title" id="inputError" placeholder="منزل من طابقين بحديقة خاصة" required>
										<?php if ( !empty( $err ) ) : ?>
											<span class="help-block"><?= $err; ?> </span>
										<?php endif; ?>	
								    </div>
								</div>
							</div>
							<!--/span-->
							<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-md-3">القسم</label>
									<div class="col-md-9">
										<select class="form-control" name="type_id" required>
											<option value="1">سياحة</option>
											<option value="2">أعمال</option>
										</select> 
									</div>
								</div>
							</div>
							<!--/span-->
						</div>
						<!--/row-->
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-md-3">التفاصيل </label>
									<div class="col-md-9">
										<textarea type="text" class="form-control" name="details" placeholder="تفاصيل العقار"></textarea>
									 </div>
								</div>
							</div>
							<!--/span-->
							<div class="col-md-6">
							<?php if ( !empty( $picerr ) ) : ?>
								<div class="form-group has-error">
							<?php else : ?>
								<div class="form-group">
							<?php endif; ?>
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
						</div>
						<!--/row-->
					</div>
					<div class="form-actions">
						<div class="row">
							<div class="col-md-6">
								<div class="row">
									<div class="col-md-offset-3 col-md-9">
										<button type="submit" class="btn green suz">حفظ</button>
										<a href="<?= AdminPanel .'blog'?>" class="btn default">رجوع</a>
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