<?php require (dirname(__FILE__) . '/../header.php') ?>
                        <!-- END PAGE HEADER-->
                        <div class="row">
                            <div class="col-md-12">
                                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                <div class="portlet box blue">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-tv"></i>عرض المدن</div>
                                        <div class="tools"> </div>
                                    </div>
                                    <div class="portlet-body">
                                        <table class="table table-striped table-bordered table-hover" id="sample_2">
                                            <thead>
                                                <tr>
                                                    <th> المسلسل </th>
                                                    <th> الاسم </th>
                                                    <th> معلومات </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach ($cities as $city ) : ?>
                                                <tr>
                                                    <td> <?= $city['id'] ?> </td>
                                                    <td> <?= $city['name'] ?> </td>
                                                    <td> 
                                                        <a href="<?= UrlPath . '/edit/'. $city['id'] ?>"> <img src="<?= BackEndUrl; ?>assets/pics/edit.png" data-toggle="tooltip" title="تعديل" class="icnz" alt="تعديل" ></a>
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