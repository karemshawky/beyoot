<?php require (dirname(__FILE__) . '/../header.php') ?>
                        <!-- END PAGE HEADER-->
                        <div class="row">
                            <div class="col-md-12">
                                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                <div class="portlet box blue">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-tv"></i>عرض الصور المتحركة </div>
                                        <div class="tools"> </div>
                                    </div>
                                    <div class="portlet-body">
                                        <table class="table table-striped table-bordered table-hover" id="sample_2">
                                            <thead>
                                                <tr>
                                                    <th> المسلسل </th>
                                                    <th> العنوان </th>
                                                    <th> المكان </th>
                                                    <th> معلومات </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach ( $sliders as $slider ) : ?>
                                                <tr>
                                                    <td> <?= $slider['id'] ?> </td>
                                                    <td> <?= $slider['title'] ?> </td>
                                                    <td> 
                                                    <?php if ( $slider['position'] == 1 ) : echo "أعلى يمين"; 
                                                       elseif( $slider['position'] == 2 ) : echo "أسفل يمين"; 
                                                       elseif( $slider['position'] == 3 ) : echo "أعلى يسار"; 
                                                       elseif( $slider['position'] == 4 ) : echo "أسفل يسار"; 
                                                       endif; 
                                                    ?> 
                                                    </td>
                                                    <td>
                                                        <a href="<?= UrlPath . '/show/'. $slider['id'] ?>"> <img src="<?= BackEndUrl; ?>assets/pics/show.png" data-toggle="tooltip" title="عرض" class="icnz" alt="عرض" ></a> 
                                                        <a href="<?= UrlPath . '/edit/'. $slider['id'] ?>"> <img src="<?= BackEndUrl; ?>assets/pics/edit.png" data-toggle="tooltip" title="تعديل" class="icnz" alt="تعديل" ></a>
                                                        <form action="<?= UrlPath . '/delete/'. $slider['id'] ?>" method="post" style="display: inline;position: absolute;"> 
                                                            <input type="hidden" name="_METHOD" value="DELETE"/>
                                                            <input type="image" class="icnz" src="<?= BackEndUrl; ?>assets/pics/delete.png" data-toggle="tooltip" title="حذف" alt="حذف" />
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