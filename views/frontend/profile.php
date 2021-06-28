<div id="content-container">
    <div class="pageheader">
        <h3><i><img src="<?php echo SITE_URL . '/uploads/logo/company_icons/icons_flex-01.png'; ?>" style ="width:40px;height:40px;margin:0 10px;"  alt="Home Picture"></i> <?php echo $lang['your_profile']; ?></h3>
        <div class="breadcrumb-wrapper">
            <span class="label"><?php echo $lang['you_are_here']; ?>:</span>
            <ol class="breadcrumb">
                <li> <a href="<?php echo ($_SESSION['department'] == 2) ? '#' :  $link->link('home', frontend); ?>"> <?php echo $lang['dashboard']; ?> </a> </li>
                <li class="active"><?php echo $lang['your_profile']; ?></li>
            </ol>
        </div>
    </div>
    <div id="page-content">
        <div class="row">
            <?php echo $display_msg; ?>
            <div class="eq-height">
                <div class="col-sm-12 eq-box-sm">
                    <div class="panel">
                        <div class="panel-heading">
                            <div class="panel-control">
                                <button class="btn btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></button>
                                <button class="btn btn-default" data-click="panel-reload"><i class="fa fa-refresh"></i></button>
                                <button class="btn btn-default" data-click="panel-collapse"><i class="fa fa-chevron-down"></i></button>
                                <button class="btn btn-default" data-dismiss="panel"><i class="fa fa-times"></i></button>
                            </div>
                            <h3 class="panel-title"><?php echo $lang['update_your_profile_details']; ?></h3>
                        </div>
                        <!--Block Styled Form -->
                        <!--===================================================-->
                        <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" id="profileForm">
                            <input type="hidden" name="profilesize" id="profilesize">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label class="control-label"><?php echo $lang['email']; ?></label>
                                            <input class="form-control" name="username" disabled type="text" value="<?php echo $_SESSION['email']; ?>">
                                            <br>
                                            <label><?php echo $lang['profile_email_instruction']; ?></label>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label"><?php echo $lang['first_name']; ?></label>
                                            <input class="form-control" name="f_name" type="text" value="<?php echo $user_details['emp_name']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label"><?php echo $lang['last_name']; ?></label>
                                            <input class="form-control" name="l_name" type="text" value="<?php echo $user_details['emp_surname']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label"><?php echo $lang['phone']; ?> #</label>
                                            <input class="form-control" placeholder="+99-99-9999-9999" name="contact1" type="text" value="<?php echo $user_details['contact1']; ?>">
                                        </div>



                                    </div>
                                    <div class="col-sm-1"></div>
                                    <div class="col-sm-5">




                                        <div class="form-group">
                                            <label class="control-label"><?php echo $lang['upload_pic']; ?></label>
                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                <div class="fileupload-new img-thumbnail">
                                                    <?php
                                                    if (file_exists(SERVER_ROOT . '/uploads/profile/' . $user_details['emp_photo_file']) && (($user_details['emp_photo_file']) != '')) { ?>
                                                        <img src="<?php echo SITE_URL . '/uploads/profile/' . $user_details['emp_photo_file']; ?>" style="width:200px;">
                                                    <?php } else { ?>
                                                        <img src="<?php echo SITE_URL . '/uploads/noimage.png'; ?>" style="width:200px;">
                                                    <?php } ?>
                                                </div>
                                                <div>
                                                    <br>
                                                    <input type="file" name="profilepic" accept="image/*">
                                                    <br> <small>Only jpeg, png & jpeg (Max : <?php echo $upload_max_size; ?>)</small>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer text-right">
                                <button class="btn btn-info" type="submit" name="submit_profile"><?php echo $lang['submit']; ?></button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>>