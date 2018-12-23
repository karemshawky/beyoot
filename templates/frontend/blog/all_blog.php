<?php require (dirname(__FILE__) . '/../header.php') ?>
<!--Start Tourism Slider-->
<div class="tourismSlider">
    <div class="container">
        <div class="tourSlider">
        <?php if ( $sliders ) foreach ( $sliders as $slider ) : ?> 
            <div class="img" style="background: url('<?= IMG ?>thumbs/<?= $slider['pic'] ?>') no-repeat center center  ; background-size: cover;width : 100%">
                <div class="blog-title"> <p> <a href="<?= BaseUrl ?>blogs/news/<?= $slider['id'] ?>"> <?= $slider['title'] ?> </a> </p>  </div>
            </div>
        <?php endforeach; ?> 
        </div>
    </div>
</div>
<!--End Tourism Slider Section-->
<!--Start Tourism Cards Section-->
<div class="buildings tourismCards">
    <div class="container">
<?php if ( !empty($blogs) ) { foreach ( $blogs as $blog ) : ?> 
        <div class="home col-sm-4 col-xs-12">
            <div class="card blogcard">
                <div class="img">
                    <img src="<?= IMG ?>thumbs/<?= $blog['pic'] ?>" />
                </div>
                <div class="details">
                    <p class="description"> <?= $blog['title'] ?> </p>
                </div>
                <a href="<?= BaseUrl ?>blogs/news/<?= $blog['id'] ?>" class="readMore btn btn-primary center-block">تفاصيل أكثر</a>
            </div>
        </div>
        <?php endforeach; ?>
            <div class="list-more"></div>                
        <?php }else{ ?>
            <div class="row">
                <p class="text-center"> لا يوجد مقالات</p>
            </div>
        <?php } ?>
    </div>
</div>
<!--End Tourism Cards Section-->
<!--Start See More Section-->
<div class="seeMore">
    <div class="container">
        <div class="text-center">
            <form action="#" method="post">
            <input type="hidden" id="page_num" name="page_num" value="3">                
        <?php $url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
              if (strpos($url,'tourism') !== false) { ?>
                <input type="hidden" id="url" name="url" value="1">                 
        <?php } else { ?>
                <input type="hidden" id="url" name="url" value="2">
        <?php } ?> 
                <input type="submit" class="blogMore" value="تحميل المزيد"> 
            </form>   
        </div>
    </div>
</div>
<!--End See More Section-->
<?php require (dirname(__FILE__) . '/../footer.php') ?>