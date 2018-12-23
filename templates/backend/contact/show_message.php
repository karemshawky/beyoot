<?php require (dirname(__FILE__) . '/../header.php') ?>
	<!-- END PAGE HEADER-->
	<div class="tab-pane" id="tab_2">
		<div class="portlet box yellow">
			<div class="portlet-title">
			<div class="caption"> <i class="fa fa-gift"></i>عرض الأستفسار </div>
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
									<label class="control-label col-md-3">أسم المستخدم :  </label>
									<div class="col-md-9">
										<p class="form-control-static"> <?= $contact['name']?> </p>
								    </div>
								</div>
							</div>
							<!--/span-->
							<div class="row">
							<div class="col-md-6">
								<div class="form-group">
								<label class="control-label col-md-3">البريد :</label>
									<div class="col-md-9">
										<p class="form-control-static"> <?= $contact['email']?> </p>
									</div>
								</div>
							</div>
							<!--/span-->
						</div>
						<!--/row-->
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
								<label class="control-label col-md-3">الفسم :</label>
									<div class="col-md-9">
										<p class="form-control-static"> <?= ($contact['type_id'] == 1) ? 'عقارات' : 'مشاريعنا' ; ?> </p>
									</div>
								</div>
							</div>
							<!--/span-->
							<div class="col-md-6">
								<div class="form-group">
								<label class="control-label col-md-3">رقم المبنى :</label>
									<div class="col-md-9">
										<p class="form-control-static"> <?= $contact['housing_id']?> </p>
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
										<p class="form-control-static"> <?= $contact['phone']?> </p>
									</div>
								</div>
							</div>
							<!--/span-->
							<div class="col-md-6">
								<div class="form-group">
								<label class="control-label col-md-3">التاريخ :</label>
									<div class="col-md-9">
										<p class="form-control-static"> <?= $contact['created_date']?> </p>
									</div>
								</div>
							</div>
							<!--/span-->
						</div>
						<!--/row-->
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
								<label class="control-label col-md-3">التفاصيل :</label>
									<div class="col-md-9">
										<p class="form-control-static"> <?= $contact['details']?> </p>
									</div>
								</div>
							</div>
							<!--/span-->
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