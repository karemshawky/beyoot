<?php require (dirname(__FILE__) . '/../header.php') ?>
        <!--Start Header Section-->
        <div class="header">
            <div class="container">
                <div class="projectsHeader text-center">
                   <h2>مشاريعنا</h2>
                    <div class="layer">
                        <p>إذا كنت مستثمر وتود مشاركة بيوت في مشاريعها الحالية أو المستقبلية </p>
                    </div>
                    <a class="readMore btn btn-primary" data-toggle="modal" data-target="#squarespaceModal">اضغط هنا</a>
				<!-- Modal -->
				<div class="modal fade" id="squarespaceModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal"><img aria-hidden="true" src="<?= FrontEndUrl ?>assets/images/icons/close%20.svg"> <span class="sr-only">Close</span></button>
							</div>
							<div class="modal-body form">
								<!-- content goes here -->
								<p class="sendText">أرسل لنا بياناتك وسيتم التواصل معكم لتنسيق استثماركم مع بيوت</p>
                                <div class="row">
                                <?php  if (empty($_SESSION['token'])) {
                                        $_SESSION['token'] = base64_encode(openssl_random_pseudo_bytes(32)); }
                                        $token = $_SESSION['token']; ?>
                                    <form action="#" method="post" class="formz">
                                        <div class="form-group name col-xs-6">
                                            <input type="text" name="name" id="name" class="form-control" required="required" placeholder="الاسم"> </div>
                                        <div class="form-group number col-xs-6">
                                            <input type="text" name="phone" id="phone" class="form-control" required="required" placeholder="رقم الجوال"> </div>
                                        <div class="form-group col-xs-12">
                                            <input type="email" name="email" id="email" class="form-control" required="required" placeholder="البريد الإلكترونى"> </div>
                                        <div class="form-group col-xs-12">
                                            <textarea class="form-control" name="details" id="details" required="required" placeholder="ملاحظات" rows="5"></textarea>
                                        </div>
                                        <div class="form-group col-xs-12">
                                            <input type="hidden" name="token" value="<?= $token ?>">
                                            <input type="hidden" id="typid" name="type_id" value="2">
                                            <input type="hidden" id="husid" name="housing_id" value="0">
                                            <button id="formcontact" type="submit" class="col-xs-12 sendForm">أرسل</button>
                                        </div>
                                    </form>
                                </div>
							</div>
							<div class="modal-body success hide">
								<!-- Successful Message -->
                                <img src="<?= FrontEndUrl ?>assets/images/icons/face.svg">
								<p class="successMsg center-block">شكراً .. تم إرسال بياناتكم للإدارة وسيتم التواصل معكم في أقرب وقت</p>
							</div>
						</div>
					</div>
				</div>
                </div>
            </div>
        </div>
        <!--End Header Section-->
        <!--Start Buildings Section-->
        <div class="buildings">
            <div class="container">
            <?php if ($projects) { foreach ( $projects as $project ) : ?>
                <div class="home col-sm-4 col-xs-12">
                    <div class="card">
                        <div class="img">
                            <img src="<?= BaseUrl ?>uploads/img/thumbs/<?= $project['pic'] ?>" />
                        </div>
                        <div class="details">
                            <p class="description projDescription"> <?= $project['title'] ?> </p>
                            <div class="address">
                                <div class="icon col-xs-1">
                                    <img src="<?= FrontEndUrl ?>assets/images/icons/location%20brown%20.svg" />
                                </div>
                                <div class="addr col-xs-11">
                                    <address><?= $project['address'] ?> <a target="_blank" href="https://www.google.com/maps/?q=<?= $project['lat'] ?>,<?= $project['lang'] ?>" class="show">(عرض على الخريطة)</a> </address>
                                </div>
                            </div>
                            <a href="<?= BaseUrl ?>projects/details/<?= $project['id'] ?>" class="readMore btn btn-primary center-block">تفاصيل المشروع</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            <div class="list-more"></div>                
            <?php }else{ ?>
                <div class="row">
                    <p class="text-center"> <?= $err ?></p>
                </div>
            <?php } ?>
            </div>
        </div>
        <!--End Buildings Section-->
        <!--Start See More Section-->
        <div class="seeMore">
            <div class="container">
                <div class="text-center">
                    <form action="#" method="post">
                        <input type="hidden" id="page_num" name="page_num" value="2">
                        <input type="hidden" id="url" value="projects">
                        <input type="submit" class="loadMore" value="تحميل المزيد"> 
                    </form>   
                </div>
            </div>
        </div>
        <!--End See More Section-->
<?php require (dirname(__FILE__) . '/../footer.php') ?>