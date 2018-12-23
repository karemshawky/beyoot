<?php require (dirname(__FILE__) . '/../header.php') ?>
                        <!-- END PAGE HEADER-->
                        <div class="row">
                            <div class="col-md-12">
                                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                <div class="portlet box blue">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-tv"></i>عن التطبيق</div>
                                        <div class="tools"> </div>
                                    </div>
                                    <div class="portlet-body">
                                        <table class="table table-striped table-bordered table-hover" id="sample_2">
                                            <thead>
                                                <tr>
                                                    <th> المسلسل </th>
                                                    <th> الهاتف </th>
                                                    <th> Facebook </th>
                                                    <th> Twitter </th>
                                                    <th> Instagram </th>
                                                    <th> Youtube </th>
                                                    <th> Andriod </th>
                                                    <th> IOS </th>
                                                    <th> فيديو </th>
                                                    <th> معلومات </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach ($settings as $info ) : ?>
                                                <tr>
                                                    <td> <?= $info['id'] ?> </td>
                                                    <td> <?= $info['phone'] ?> </td>
                                                    <td> <?= $info['facebook'] ?> </td>
                                                    <td> <?= $info['twitter'] ?> </td>
                                                    <td> <?= $info['instagram'] ?> </td>
                                                    <td> <?= $info['youtube'] ?> </td>
                                                    <td> <?= $info['andriod'] ?> </td>
                                                    <td> <?= $info['ios'] ?> </td>
                                                    <td> <?= $info['video'] ?> </td>
                                                    <td> 
                                                        <a href="<?= UrlPath . '/edit/'. $info['id'] ?>"> <img src="<?= BackEndUrl; ?>assets/pics/edit.png" data-toggle="tooltip" title="تعديل" class="icnz" alt="تعديل" ></a>
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