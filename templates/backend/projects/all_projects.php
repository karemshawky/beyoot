<?php require (dirname(__FILE__) . '/../header.php') ?>
                        <!-- END PAGE HEADER-->
                        <div class="row">
                            <div class="col-md-12">
                                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                <div class="portlet box blue">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-tv"></i>عرض المشاريع</div>
                                        <div class="tools"> </div>
                                    </div>
                                    <div class="portlet-body">
                                        <table class="table table-striped table-bordered table-hover" id="sample_2">
                                            <thead>
                                                <tr>
                                                    <th> المسلسل </th>
                                                    <th> أسم المشروع </th>
                                                    <th> العنوان </th>
                                                    <th> التفاصيل </th>
                                                    <th> المرحلة الحالية </th>
                                                    <th> تاريخ الاضافة </th>
                                                    <th> معلومات </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach ($projects as $project ) : ?>
                                                <tr>
                                                    <td> <?= $project['id'] ?> </td>
                                                    <td> <?= $project['title'] ?> </td>
                                                    <td> <?= $project['address'] ?> </td>
                                                    <td> <?= mb_substr($project['details'], 0, 50) . ' ...'; ?> </td>
                                                    <td> <?= mb_substr($project['current_phase'], 0, 50) . ' ...'; ?> </td>
                                                    <td> <?= $project['created_date'] ?> </td>
                                                    <td> 
                                                        <a href="<?= UrlPath . '/addimg/'. $project['id'] ?>"> <img src="<?= BackEndUrl; ?>assets/pics/images.png" data-toggle="tooltip" title="إضافة صور" class="icnz" alt="إضافة صور" ></a>
                                                        <a href="<?= UrlPath . '/show/'. $project['id'] ?>"> <img src="<?= BackEndUrl; ?>assets/pics/show.png" data-toggle="tooltip" title="عرض" class="icnz" alt="عرض" ></a>
                                                        <a href="<?= UrlPath . '/edit/'. $project['id'] ?>"> <img src="<?= BackEndUrl; ?>assets/pics/edit.png" data-toggle="tooltip" title="تعديل" class="icnz" alt="تعديل" ></a>
                                                        <form action="<?= UrlPath . '/delete/'. $project['id'] ?>" method="post" style="display: inline;position: absolute;"> 
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