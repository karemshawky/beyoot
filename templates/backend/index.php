<?php require 'header.php'; ?>				
					<!-- END PAGE HEADER-->
					<!-- BEGIN DASHBOARD STATS 1-->
					<div class="row">
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
							<a class="dashboard-stat dashboard-stat-v2 blue" href="<?= AdminPanel; ?>housing">
								<div class="visual"> <i class="fa fa-home"></i> </div>
								<div class="details">
									<div class="number"> <span data-counter="counterup" data-value="<?= $housing; ?>">0</span> </div>
									<div class="desc"> العقارات </div>
								</div>
							</a>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
							<a class="dashboard-stat dashboard-stat-v2 red" href="<?= AdminPanel; ?>users">
								<div class="visual"> <i class="fa fa-users"></i> </div>
								<div class="details">
									<div class="number"> <span data-counter="counterup" data-value="<?= $users; ?>">0</span> </div>
									<div class="desc"> المستخدمين </div>
								</div>
							</a>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
							<a class="dashboard-stat dashboard-stat-v2 green" href="<?= AdminPanel; ?>blog">
								<div class="visual"> <i class="fa fa-plane"></i> </div>
								<div class="details">
									<div class="number"> <span data-counter="counterup" data-value="<?= $bussiness; ?>">0</span> </div>
									<div class="desc"> مقالات السياحة </div>
								</div>
							</a>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
							<a class="dashboard-stat dashboard-stat-v2 yellow" href="<?= AdminPanel; ?>blog">
								<div class="visual"> <i class="fa fa-newspaper-o"></i> </div>
								<div class="details">
									<div class="number"> <span data-counter="counterup" data-value="<?= $tourism; ?>">0</span> </div>
									<div class="desc"> مقالات الأعمال  </div>
								</div>
							</a>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
							<a class="dashboard-stat dashboard-stat-v2 purple" href="<?= AdminPanel; ?>project">
								<div class="visual"> <i class="fa fa-building"></i> </div>
								<div class="details">
									<div class="number"> <span data-counter="counterup" data-value="<?= $projects; ?>"></span> </div>
									<div class="desc"> مشاريعنا </div>
								</div>
							</a>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
							<a class="dashboard-stat dashboard-stat-v2 blue" href="<?= AdminPanel; ?>cities">
								<div class="visual"> <i class="fa fa-globe"></i> </div>
								<div class="details">
									<div class="number"> <span data-counter="counterup" data-value="<?= $cities; ?>">0</span> </div>
									<div class="desc"> المدن </div>
								</div>
							</a>
						</div>
					</div>
					<div class="clearfix"></div>
					<!-- END DASHBOARD STATS 1-->
<?php require 'footer.php'; ?>