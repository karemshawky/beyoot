<?php require (dirname(__FILE__) . '/../header.php') ?>
                        <!-- END PAGE HEADER-->
                        <div class="row">
                            <div class="col-md-12">
                                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                <div class="portlet box blue">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-tv"></i>عرض المقالات </div>
                                        <div class="tools"> </div>
                                    </div>
                                    <div class="portlet-body">
                                        <table class="table table-striped table-bordered table-hover" id="sample_2">
                                            <thead>
                                                <tr>
                                                    <th> المسلسل </th>
                                                    <th> أسم المقال </th>
                                                    <th> القسم </th>
                                                    <th> تاريخ الاضافة </th>
                                                    <th> معلومات </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach ($news as $blog ) : ?>
                                                <tr>
                                                    <td> <?= $blog['id'] ?> </td>
                                                    <td> <?= $blog['title'] ?> </td>
                                                    <td> <?= ( $blog['type_id'] == 1 ) ? 'سياحة': 'أعمال'; ?> </td>
                                                    <td> <?= $blog['created_date'] ?> </td>
                                                    <td> 
                                                        <a href="<?= UrlPath . '/show/'. $blog['id'] ?>"> <img src="<?= BackEndUrl; ?>assets/pics/show.png" data-toggle="tooltip" title="عرض" class="icnz" alt="عرض" ></a>
                                                        <a href="<?= UrlPath . '/edit/'. $blog['id'] ?>"> <img src="<?= BackEndUrl; ?>assets/pics/edit.png" data-toggle="tooltip" title="تعديل" class="icnz" alt="تعديل" ></a>
                                                        <form action="<?= UrlPath . '/delete/'. $blog['id'] ?>" method="post" style="display: inline;position: absolute;"> 
                                                            <input type="hidden" name="_METHOD" value="DELETE"/>
                                                            <input type="image" class="icnz" src="<?= BackEndUrl; ?>assets/pics/delete.png" alt="أزالة" />
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