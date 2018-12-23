<?php require (dirname(__FILE__) . '/../header.php') ?>
                        <!-- END PAGE HEADER-->
                        <div class="row">
                            <div class="col-md-12">
                                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                <div class="portlet box blue">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-tv"></i>عرض الأستفسارات </div>
                                        <div class="tools"> </div>
                                    </div>
                                    <div class="portlet-body">
                                        <table class="table table-striped table-bordered table-hover" id="sample_2">
                                            <thead>
                                                <tr>
                                                    <th> المسلسل </th>
                                                    <th> أسم المستخدم </th>
                                                    <th> البريد </th>
                                                    <th> الهاتف </th>
                                                    <th> الرسالة </th>
                                                    <th> رقم المبنى </th>
                                                    <th> تاريخ الاضافة </th>
                                                    <th> معلومات </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach ($contact as $info ) : ?>
                                                <tr>
                                                    <td> <?= $info['id'] ?> </td>
                                                    <td> <?= $info['name'] ?> </td>
                                                    <td> <?= $info['email'] ?> </td>
                                                    <td> <?= $info['phone'] ?> </td>
                                                    <td> <?= mb_substr($info['details'], 0, 30) . ' ...'; ?> </td>
                                                    <td> <?= $info['housing_id'] ?> </td>
                                                    <td> <?= $info['created_date'] ?> </td>
                                                    <td> 
                                                        <a href="<?= BaseUrl . 'admin-panel/contact/show/'. $info['id'] ?>"> <img src="<?= BackEndUrl; ?>assets/pics/show.png" data-toggle="tooltip" title="عرض" class="icnz" alt="عرض" ></a>
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