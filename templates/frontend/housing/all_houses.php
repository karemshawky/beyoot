<?php require (dirname(__FILE__) . '/../header.php') ?>
        <!--Start Header Section-->
        <div class="header">
            <div class="container">
                <div class="projectsHeader propertiesHeader text-center">
                    <h2>العقارات في البوسنة</h2>
                    <div class="layer">
                        <p>العقار أفضل استثمار .. حيث تتمتع بالرفاهية وتنمي أموالك</p>
                    </div>
                </div>
            </div>
        </div>
        <!--End Header Section-->
        <!--Start Filter Section-->
        <div class="filter">
            <div class="container">
                <div class="filter-component">
                <?php  if (empty($_SESSION['token'])) {
                       $_SESSION['token'] = base64_encode(openssl_random_pseudo_bytes(32)); }
                       $token = $_SESSION['token']; ?>
                    <form action="<?= htmlspecialchars(BaseUrl .'housing/search') ?>" method="post"> 
                        <select name="city_id">
                            <option data-display="كل المدن" value="0">الكل</option>
                            <?php foreach ( $cities as $city ) : ?> 
                                <option value="<?= $city['id'] ?>" <?php if (isset( $_POST['city_id'] ) && $city['id'] == $_POST['city_id'] ) { echo "selected='selected'";} ?>  > <?= $city['name'] ?> </option>
                            <?php endforeach; ?>
                        </select>
                        <select name="type_id">
                            <option data-display="كل أنواع العقارات" value="0">الكل</option>
                            <?php foreach ( $types as $type ) : ?> 
                                <option value="<?= $type['id'] ?>" <?php if (isset( $_POST['type_id'] ) && $type['id'] == $_POST['type_id'] ) { echo "selected='selected'";} ?> > <?= $type['name'] ?> </option>
                            <?php endforeach; ?>
                        </select>
                        <label>السعر من: </label>
                        <input class="form-control priceInput" placeholder="0.00" type="number" name="price_from" value="<?= ( @$_POST['price_from'] )?$_POST['price_from']:''; ?>" >
                        <label class="to">إلى: </label>
                        <input class="form-control priceInput" placeholder="0.00" type="number" name="price_to" value="<?= ( @$_POST['price_to'] )?$_POST['price_to']:''; ?>" >
                        <label>ريال سعودي </label>
                        <input type="hidden" name="token" value="<?= $token ?>">
                        <input type="hidden" id="page_numz" name="page_numz" value="2">
                        <input class="btn readMore filterSubmit btn-primary" type="submit" value="تصفية">
                    </form>
                </div>
            </div>
        </div>
        <!--End Filter Section-->
        <!--Start Buildings Section-->
        <div class="buildings">
            <div class="container">
            <?php if( !empty ($housing) ) { foreach ($housing as $house) : ?>
                <div class="home col-sm-4 col-xs-12">
                    <div class="card">
                        <div class="img">
                        <img src="<?= BaseUrl ?>uploads/img/thumbs/<?= $house['pic'] ?>" />
                        </div>
                        <div class="details">
                            <p class="price">
                                <span class="number"><?= number_format($house['price']) ?> </span>ريال سعودي
                            </p>
                            <p class="description"><span class="type"> <?= (@$house['tpy'])?$house['tpy']:$house['type']; ?> </span> - <?= $house['title'] ?> </p>
                            <div class="address">
                                <div class="icon col-xs-1">
                                    <img src="<?= FrontEndUrl ?>assets/images/icons/location%20brown%20.svg" />
                                </div>
                                <div class="addr col-xs-11">
                                    <address><?= mb_substr($house['address'], 0, 50) . ' ...'; ?> <a target="_blank" href="https://www.google.com/maps/?q=<?=$house['lat'] ?>,<?=$house['lang'] ?>" class="show">(عرض على الخريطة)</a> </address>
                                </div>
                            </div>
                            <a href="<?= BaseUrl ?>housing/details/<?= $house['id'] ?>" class="readMore btn btn-primary center-block">تفاصيل أكثر</a>
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
                <?php $url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
                          if (strpos($url,'search') !== false) { ?>
                        <input type="submit" class="schMore" value="تحميل المزيد"> 
                <?php } else { ?>
                        <input type="hidden" id="page_num" name="page_num" value="2">
                        <input type="hidden" id="url" value="housing">
                        <input type="submit" class="loadMore" value="تحميل المزيد"> 
                <?php } ?> 
                    </form>   
                </div>
            </div>
        </div>
        <!--End See More Section-->
<?php require (dirname(__FILE__) . '/../footer.php') ?>