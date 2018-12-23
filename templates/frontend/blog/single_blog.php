<?php require (dirname(__FILE__) . '/../header.php') ?>
<!--Start Details Slider Section-->
<div class="deatailsSlider">
    <div class="container">
        <div class="tourismDetails">
            <div class="img">
                <h2 class="col-sm-9 touris-text"> <?= $blog['title']; ?> </h2>
                <div class="col-sm-2 tourism-img">

                    <?php if ( $_SESSION['userid'] && $blog['is_fav'] == 1 ) { ?> 
                        <form action="<?= BaseUrl ?>user/delfav" method="post" style="float: left;margin-right: 5px;">
                            <input type="hidden" name="_METHOD" value="DELETE"/>
                            <?php if ( $blog['type_id'] == 1 ) : ?>
                                <input type="hidden" name="type_id" value="2">
                            <?php elseif ( $blog['type_id'] == 2 ) : ?>
                                <input type="hidden" name="type_id" value="3">
                            <?php endif; ?>
                            <input type="hidden" name="number_id" value="<?= $blog['id'] ?>"> 
                            <input type="image" src="<?= FrontEndUrl ?>assets/images/star2.png" alt="حذف" data-toggle="tooltip" title=" حذف"/>
                        </form>
                    <?php } if( $_SESSION['userid'] && $blog['is_fav'] == 0 ) { ?> 
                        <form action="<?= BaseUrl ?>user/addfav" method="post" style="float: left;margin-right: 5px;">
                            <?php if ( $blog['type_id'] == 1 ) : ?>
                                <input type="hidden" name="type_id" value="2">
                            <?php elseif ( $blog['type_id'] == 2 ) : ?>
                                <input type="hidden" name="type_id" value="3">
                            <?php endif; ?>
                            <input type="hidden" name="number_id" value="<?= $blog['id'] ?>"> 
                            <input type="image" src="<?= FrontEndUrl ?>assets/images/star1.png" alt="أضف" data-toggle="tooltip" title=" أضف"/>
                        </form>
                    <?php } if( $_SESSION['userid'] == 0 ) { ?> 
                        <a class="last notlogin" href="#"><img style="float: left;margin-right: 5px;" src="<?= FrontEndUrl ?>assets/images/star1.png "></a>
                    <?php } ?>	
                </div>
                <img src="<?= IMG ?>thumbs/<?= $blog['pic'] ?>" />
            </div>
        </div>
    </div>
</div>
<!--End Details Slider Section-->
<!--Start All Details Section-->
<div class="allDetails"><br>
    <div class="container">
        <div class="row">
            <div class="container">
                <div class="basicDtails tourism col-sm-8">
                    <?= $blog['details']; ?>
                </div>
                <div class="col-sm-3">
                    <div class="stage tourismArticle col-sm-12 col-xs-12">
                        <h2 class="projStatus text-center">مقالات متعلقة</h2>
                    </div>
                    <div class="buildings tourismCards">
                            <div class="home col-sm-12 col-xs-12">
                            <?php foreach( $theNew as $new) : ?>
                                <div class="card related">
                                    <div class="img">
                                        <img src="<?= IMG ?>thumbs/<?= $new['pic'] ?>" />
                                    </div>
                                    <div class="details">
                                        <p class="description"> <a class="ahr" href="<?= BaseUrl ?>blogs/news/<?= $new['id'] ?>"> <?= mb_substr($new['title'], 0, 70) . ' ...'; ?> </a> </p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End All Details Section-->
<?php require (dirname(__FILE__) . '/../footer.php') ?>