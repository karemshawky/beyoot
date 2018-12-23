<?php require (dirname(__FILE__) . '/../header.php') ?>
	<!-- END PAGE HEADER-->
	<div class="tab-pane" id="tab_2">
		<div class="portlet box green">
			<div class="portlet-title">
				<div class="caption"> <i class="fa fa-plus-circle"></i>إضافة صور للعقار </div>
				<div class="tools">
					<a href="javascript:;" class="collapse"> </a>
					<a href="javascript:;" class="fullscreen"> </a>
				</div>
			</div>
			<div class="portlet-body form">
				<!-- BEGIN FORM-->
				<form action="<?= BaseUrl ?>admin-panel/housing/saveimg" method="post" class="form-horizontal" enctype="multipart/form-data">
				<input type="hidden" name="id" value="<?=$id?>">
				<input type="hidden" name="type" value="2">
					<div class="form-body">
						<h3 class="form-section">التفاصيل</h3>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group ">
									<label class="control-label col-md-3"> صورة 1 </label>
									<div class="col-md-9">
										<input type="text" class="form-control" name="detail-1" id="inputError" placeholder="تفاصيل الصورة">
								    </div>
								</div>
							</div>
							<!--/span-->
							<div class="col-md-6">
								<div class="form-group ">
									<div class="col-md-9">
										<input type="file" name="pic-1">
								    </div>
								</div>
							</div>
							<!--/span-->
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group ">
									<label class="control-label col-md-3"> صورة 2 </label>
									<div class="col-md-9">
										<input type="text" class="form-control" name="detail-2" id="inputError" placeholder="تفاصيل الصورة">
								    </div>
								</div>
							</div>
							<!--/span-->
							<div class="col-md-6">
								<div class="form-group ">
									<div class="col-md-9">
										<input type="file" name="pic-2">
								    </div>
								</div>
							</div>
							<!--/span-->
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group ">
									<label class="control-label col-md-3"> صورة 3 </label>
									<div class="col-md-9">
										<input type="text" class="form-control" name="detail-3" id="inputError" placeholder="تفاصيل الصورة">
								    </div>
								</div>
							</div>
							<!--/span-->
							<div class="col-md-6">
								<div class="form-group ">
									<div class="col-md-9">
										<input type="file" name="pic-3">
								    </div>
								</div>
							</div>
							<!--/span-->
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group ">
									<label class="control-label col-md-3"> صورة 4 </label>
									<div class="col-md-9">
										<input type="text" class="form-control" name="detail-4" id="inputError" placeholder="تفاصيل الصورة">
								    </div>
								</div>
							</div>
							<!--/span-->
							<div class="col-md-6">
								<div class="form-group ">
									<div class="col-md-9">
										<input type="file" name="pic-4">
								    </div>
								</div>
							</div>
							<!--/span-->
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group ">
									<label class="control-label col-md-3"> صورة 5 </label>
									<div class="col-md-9">
										<input type="text" class="form-control" name="detail-5" id="inputError" placeholder="تفاصيل الصورة">
								    </div>
								</div>
							</div>
							<!--/span-->
							<div class="col-md-6">
								<div class="form-group ">
									<div class="col-md-9">
										<input type="file" name="pic-5">
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
										<a href="<?= AdminPanel .'housing'?>" class="btn default">رجوع</a>
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