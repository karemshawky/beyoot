<?php require (dirname(__FILE__) . '/../header.php') ?>
	<!-- END PAGE HEADER-->
	<div class="tab-pane" id="tab_2">
		<div class="portlet box red">
			<div class="portlet-title">
				<div class="caption"> <i class="fa fa-pencil"></i>تعديل عقار </div>
				<div class="tools">
					<a href="javascript:;" class="collapse"> </a>
					<a href="javascript:;" class="fullscreen"> </a>
				</div>
			</div>
			<div class="portlet-body form">
				<!-- BEGIN FORM-->
				<form action="<?= BaseUrl ?>admin-panel/housing/update/<?= $house['id'] ;?>" method="post" class="form-horizontal" enctype="multipart/form-data">
					<input type="hidden" name="_METHOD" value="PUT"/>	
					<div class="form-body">
						<h3 class="form-section">التفاصيل</h3>
						<div class="row">
							<div class="col-md-6">
							<?php if ( !empty( $err ) ) : ?>
								<div class="form-group has-error">
							<?php else : ?>	
								<div class="form-group ">
							<?php endif; ?>	
									<label class="control-label col-md-3"> أسم العقار </label>
									<div class="col-md-9">
										<input type="text" class="form-control" name="title" value="<?= $house['title'] ;?>" id="inputError">
										<?php if ( !empty( $err ) ) : ?>
											<span class="help-block"><?= $err; ?> </span>
										<?php endif; ?>	
								    </div>
								</div>
							</div>
							<!--/span-->
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-md-3">التفاصيل </label>
									<div class="col-md-9">
										<textarea type="text" name="description" class="form-control" > <?= $house['description'] ;?> </textarea>
									 </div>
								</div>
							</div>
							<!--/span-->
						</div>
						<!--/row-->
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-md-3">النوع</label>
									<div class="col-md-9">
										<select class="form-control" name="type_id">
										<?php if ($type) foreach ($type as $tpy) : ?> 
											<option value="<?= $tpy['id'] ?>" <?php if( $house['type_id'] == $tpy['id'] ) echo" selected='selected'";?> ><?=$tpy['name']?></option>
										<?php endforeach; ?>	
										</select> 
									</div>
								</div>
							</div>
							<!--/span-->
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-md-3">المدينة</label>
									<div class="col-md-9">
										<select class="form-control" name="city_id">
										<?php if ($city) foreach ($city as $cty) : ?> 
											<option value="<?= $cty['id'] ?>" <?php if( $house['city_id'] == $cty['id'] ) echo" selected='selected'";?> ><?=$cty['name']?></option>
										<?php endforeach; ?>		
										</select> 
									</div>
								</div>
							</div>
							<!--/span-->
						</div>
						<!--/row-->
						<div class="row">
							<div class="col-md-6">
							<?php if ( !empty( $err ) ) : ?>
								<div class="form-group has-error">
							<?php else : ?>	
								<div class="form-group ">
							<?php endif; ?>	
									<label class="control-label col-md-3">السعر</label>
									<div class="col-md-9">
										<input type="number" name="price" value="<?= $house['price'] ;?>" class="form-control" placeholder="300000 ريال سعودى"> 
										<?php if ( !empty( $err ) ) : ?>
											<span class="help-block"><?= $err; ?> </span>
										<?php endif; ?>	
									</div>
								</div>
							</div>
							<!--/span-->
							<div class="col-md-6">
							<?php if ( !empty( $err ) ) : ?>
								<div class="form-group has-error">
							<?php else : ?>	
								<div class="form-group ">
							<?php endif; ?>	
									<label class="control-label col-md-3">المساحة</label>
									<div class="col-md-9">
										<input type="number" name="area" value="<?= $house['area'] ;?>" class="form-control" placeholder="400 م2"> 
										<?php if ( !empty( $err ) ) : ?>
											<span class="help-block"><?= $err; ?> </span>
										<?php endif; ?>	
									</div>
								</div>
							</div>
							<!--/span-->
						</div>
						<!--/row-->
						<div class="row">
							<div class="col-md-6">
							<?php if ( !empty( $err ) ) : ?>
								<div class="form-group has-error">
							<?php else : ?>	
								<div class="form-group ">
							<?php endif; ?>	
									<label class="control-label col-md-3">الهاتف</label>
									<div class="col-md-9">
										<input type="number" name="phone" value="<?= $house['phone'] ;?>" class="form-control" >
										<?php if ( !empty( $err ) ) : ?>
											<span class="help-block"><?= $err; ?> </span>
										<?php endif; ?>	 
									</div>
								</div>
							</div>
							<!--/span-->
							<div class="col-md-6">
							<?php if ( !empty( $err ) ) : ?>
								<div class="form-group has-error">
							<?php else : ?>	
								<div class="form-group ">
							<?php endif; ?>	
									<label class="control-label col-md-3">العنوان</label>
									<div class="col-md-9">
										<input type="text" name="address" value="<?= $house['address'] ;?>" class="form-control">
										<?php if ( !empty( $err ) ) : ?>
											<span class="help-block"><?= $err; ?> </span>
										<?php endif; ?>	 
									</div>
								</div>
							</div>
							<!--/span-->
						</div>
						<!--/row-->
						<div class="row">
							<div class="col-md-6">
							<?php if ( !empty( $err ) ) : ?>
								<div class="form-group has-error">
							<?php else : ?>	
								<div class="form-group ">
							<?php endif; ?>	
									<label class="control-label col-md-3">فيديو</label>
									<div class="col-md-9">
										<input type="url" name="video" value="<?= $house['video'] ;?>" class="form-control" placeholder="https://www.youtube.com/watch?v=dX05gaxsM9g"> 
										<?php if ( !empty( $err ) ) : ?>
											<span class="help-block"><?= $err; ?> </span>
										<?php endif; ?>	 
									</div>
								</div>
							</div>
							<!--/span-->
						</div>
						<!--/row-->
						<div class="row">
							<div class="col-md-6">
							<?php if ( !empty( $picerr ) ) : ?>
								<div class="form-group has-error">
							<?php else : ?>	
								<div class="form-group ">
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
                                                <input type="file" name="pic" id="imgx"> </span> <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> حذف </a>
                                            </div>
											<?php if ( !empty( $picerr ) ) : ?>
												<span class="help-block"><?= $picerr; ?> </span>
											<?php endif; ?>	 
										</div>
									</div>
								</div>
							</div>
							<!--/span-->
							<div class="col-md-6">
							<?php if ( !empty( $errPan ) ) : ?>
								<div class="form-group has-error">
							<?php else : ?>	
								<div class="form-group ">
							<?php endif; ?>	
									<label class="control-label col-md-3">صورة 360 درجة</label>
									<div class="col-md-9">
										<div class="fileinput fileinput-new" data-provides="fileinput">
											<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;"> 
                                                <img src="<?= BackEndUrl ?>assets/global/img/no-image.png" alt="" /> </div>
											<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
											<div> 
                                                <span class="btn default btn-file">
                                                <span class="fileinput-new"> أختر صورة </span> <span class="fileinput-exists"> تغيير </span>
                                                <input type="file" name="360_degree" id="imgz"> </span> <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> حذف </a>
                                            </div>
											<?php if ( !empty( $errPan ) ) : ?>
												<span class="help-block"><?= $errPan; ?> </span>
											<?php endif; ?>	
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
								<?php if ( !empty( $err ) ) : ?>
								<div class="form-group has-error">
								<?php else : ?>	
									<div class="form-group ">
								<?php endif; ?>	
									<label class="control-label col-md-3">خط طول</label>
									<div class="col-md-9">
										<input type="text" name="lang" id="lng" value="<?= $house['lang'] ;?>" class="form-control " onClick="" placeholder="55.326412895414">
										<?php if ( !empty( $err ) ) : ?>
												<span class="help-block"><?= $err; ?> </span>
										<?php endif; ?>	
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<?php if ( !empty( $err ) ) : ?>
								<div class="form-group has-error">
								<?php else : ?>	
									<div class="form-group ">
								<?php endif; ?>	
									<label class="control-label col-md-3">خط عرض</label>
									<div class="col-md-9">
										<input type="text" id="lat" class="form-control " onClick="" value="<?= $house['lat'] ;?>" name="lat" placeholder="51.326499898814">
										<?php if ( !empty( $err ) ) : ?>
												<span class="help-block"><?= $err; ?> </span>
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
						<h3 class="form-section">تفاصيل للعقار</h3>
						<!--/row-->
						<div class="row">
						<?php if($additions) foreach ( $additions as $adds ) :
							  if ( $adds['type_id'] == 1) : ?>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-md-3"> <?= $adds['tpy'] ?>  </label>
									<div class="col-md-5">
										<select class="form-control" name="<?= $adds['type'] ?>">
											<option value="0" <?php if( $adds['value'] == 0 ) echo" selected='selected' "; ?> > غير متاح </option>
											<option value="1" <?php if( $adds['value'] == 1 ) echo" selected='selected' "; ?> > متاح </option>
										</select> 
                                    </div>
								</div>
							</div>			
							<?php elseif ( $adds['type_id'] == 2 ) : ?>
							<div class="col-md-6">
								<?php if ( !empty( $err ) ) : ?>
								<div class="form-group has-error">
								<?php else : ?>	
									<div class="form-group ">
								<?php endif; ?>	
									<label class="control-label col-md-3"> <?= $adds['tpy'] ?> </label>
									<div class="col-md-9">
										<input type="number" name="<?= $adds['type'] ?>" value="<?= $adds['value'] ?>" class="form-control" placeholder="0">
										<?php if ( !empty( $err ) ) : ?>
												<span class="help-block"><?= $err; ?> </span>
										<?php endif; ?>	
									</div>
								</div>
							</div>
						<?php endif; endforeach; ?>
						</div>
					</div>
					<div class="form-actions">
						<div class="row">
							<div class="col-md-6">
								<div class="row">
									<div class="col-md-offset-3 col-md-9">
										<button type="submit" class="btn red">حفظ</button>
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