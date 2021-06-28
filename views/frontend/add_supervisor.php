<div id="content-container">
    <div class="pageheader hidden-xs">
        <h3><i></i><?php echo $lang['add_supervisor']; ?></h3>
        <div class="breadcrumb-wrapper">
            <span class="label"><?php echo $lang['you_are_here']; ?>:</span>
            <ol class="breadcrumb">
                <li> <a href="<?php echo $link->link('supervisors', frontend); ?>"><?php echo $lang['view_supervisors']; ?> </a> </li>
                <li class="active"><?php echo $lang['add_supervisor']; ?></li>
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
                                <button class="btn btn-default" onclick="goBack()"><i class="fa fa-arrow-circle-left"></i> <?php echo $lang['go_back']; ?></button>
                            </div>
                            <h3 class="panel-title"><?php echo $lang['add_new_supervisor']; ?></h3>
                        </div>
                        <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" id="addUserFrom">
                            <input type="hidden" name="profilesize" id="profilesize">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <div class="text-left">
                                                <label class="text-muted"><?php echo $lang['first_name']; ?> *</label>
                                                <input class="form-control" type="text" placeholder="<?php echo $lang['enter_your_name']; ?>" name="emp_name">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="text-left">
                                                <label class="text-muted"><?php echo $lang['last_name']; ?></label>
                                                <input class="form-control" type="text" placeholder="<?php echo $lang['enter_your_surname']; ?>" name="emp_surname">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="text-left">
                                                <label class="text-muted"><?php echo $lang['email_id']; ?> *</label>
                                                <input class="form-control" type="text" placeholder="<?php echo $lang['enter_your_email_address']; ?>" name="email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="text-left">
                                                <label class="text-muted"><?php echo $lang['password']; ?> *</label>
                                                <input class="form-control" type="password" placeholder="<?php echo $lang['enter_password']; ?>" name="password">
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <div class="text-left">
                                                <label class="text-muted"><?php echo $lang['address']; ?></label>
                                                <textarea class="form-control" name="address" placeholder="<?php echo $lang['enter_your_address']; ?>"></textarea>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-sm-1"></div>
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <div class="text-left">
                                                <label class="text-muted"><?php echo $lang['phone_number']; ?></label>
                                                <input class="form-control" type="text" placeholder="<?php echo $lang['enter_your_phone_number']; ?>" name="contact1">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label"><?php echo $lang['upload_pic']; ?></label>
                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                <div class="fileupload-new img-thumbnail">
                                                    <img src="<?php echo SITE_URL . '/uploads/noimage.png'; ?>" width="100%">
                                                </div>
                                                <div>
                                                    <br>
                                                    <input type="file" name="img" accept="image/*">
                                                </div>
                                                <small>Only jpg , png & jpeg (Max : <?php echo $upload_max_size; ?>)</small>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="panel-footer text-center">
                                <a class="btn btn-warning" href="<?php echo $link->link('supervisors', frontend); ?>"><i class="fa fa-times"></i> <?php echo $lang['cancel']; ?></a>
                                <button class="btn btn-success" type="submit" name="submit_user"><i class="fa fa-save"></i> <?php echo $lang['submit']; ?></button>

                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>