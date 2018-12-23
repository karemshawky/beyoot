<?php require (dirname(__FILE__) . '/../header.php') ?>
                        <!-- END PAGE HEADER-->
                        <div class="row">
                            <div class="col-md-12">
                                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                <div class="portlet box blue">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-tv"></i>عرض المستخدمين</div>
                                        <div class="tools"> </div>
                                    </div>
                                    <div class="portlet-body">
                                        <table class="table table-striped table-bordered table-hover" id="sample_2">
                                            <thead>
                                                <tr>
                                                    <th> المسلسل </th>
                                                    <th> أسم المستخدم </th>
                                                    <th> الهاتف </th>
                                                    <th> تاريخ الاضافة </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php if ($users) foreach ($users as $user ) : ?>
                                                <tr>
                                                    <td> <?= $user['id'] ?> </td>
                                                    <td> <?= $user['name'] ?> </td>
                                                    <td> <?= $user['phone'] ?> </td>
                                                    <td> <?= $user['created_date'] ?> </td>
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