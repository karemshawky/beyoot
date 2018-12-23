<?php require (dirname(__FILE__) . '/../header.php') ?>
                        <!-- END PAGE HEADER-->
                        <div class="row">
                            <div class="col-md-12">
                                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                <div class="portlet box blue">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-tv"></i>عرض العقارات </div>
                                        <div class="tools"> </div>
                                    </div>
                                    <div class="portlet-body">
                                        <table class="table table-striped table-bordered table-hover" id="sample_2">
                                            <thead>
                                                <tr>
                                                    <th> المسلسل </th>
                                                    <th> أسم العقار </th>
                                                    <th> العنوان </th>
                                                    <th> النوع </th>
                                                    <th> السعر </th>
                                                    <th> المساحة </th>
                                                    <th> المدينة </th>
                                                    <th> معلومات </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php if ($housing) foreach ($housing as $house ) : ?>
                                                <tr>
                                                    <td> <?= $house['id'] ?> </td>
                                                    <td> <?= $house['title'] ?> </td>
                                                    <td> <?= $house['address'] ?> </td>
                                                    <td> <?= $house['tpy'] ?> </td>
                                                    <td> <?= $house['price'] ?> </td>
                                                    <td> <?= $house['area'] ?> </td>
                                                    <td> <?= $house['cty'] ?> </td>
                                                    <td> 
                                                        <a href="<?= UrlPath . '/addimg/'. $house['id'] ?>"> <img src="<?= BackEndUrl; ?>assets/pics/images.png" data-toggle="tooltip" title="إضافة صور عادية" class="icnz" alt="إضافة صور" ></a>
                                                        <a href="<?= UrlPath . '/addpanorama/'. $house['id'] ?>"> <img src="<?= BackEndUrl; ?>assets/pics/panorama.png" data-toggle="tooltip" title="إضافة صور 360 درجة" class="icnz" alt="إضافة صور" ></a>
                                                        <a href="<?= UrlPath . '/show/'. $house['id'] ?>"> <img src="<?= BackEndUrl; ?>assets/pics/show.png" data-toggle="tooltip" title="عرض" class="icnz" alt="عرض" ></a>
                                                        <a href="<?= UrlPath . '/edit/'. $house['id'] ?>"> <img src="<?= BackEndUrl; ?>assets/pics/edit.png" data-toggle="tooltip" title="تعديل" class="icnz" alt="تعديل" ></a>
                                                        <form action="<?= UrlPath . '/delete/'. $house['id'] ?>" method="post" style="display: inline;position: absolute;"> 
                                                            <input type="hidden" name="_METHOD" value="DELETE"/>
                                                            <input type="image" class="icnz" src="<?= BackEndUrl; ?>assets/pics/delete.png" alt="أزالة" data-toggle="tooltip" title=" حذف"/>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>    
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- END EXAMPLE TABLE PORTLET-->
                            </div>
                        </div>
                    </div>
<?php require (dirname(__FILE__) . '/../footer.php') ?>