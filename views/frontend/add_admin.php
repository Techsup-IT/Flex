<div id="content-container">
    <div class="pageheader hidden-xs">
        <h3><i></i>Add Admin</h3>
        <div class="breadcrumb-wrapper">
            <span class="label">You are here:</span>
            <ol class="breadcrumb">
                <li> <a href="<?php echo $link->link('admin', frontend); ?>">View Admin </a> </li>
                <li class="active">Add Admin</li>
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
                                <button class="btn btn-default" onclick="goBack()"><i class="fa fa-arrow-circle-left"></i> Go Back</button>
                            </div>
                            <h3 class="panel-title">Add New Admin</h3>
                        </div>
                        <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" id="addUserFrom">
                            <input type="hidden" name="profilesize" id="profilesize">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <div class="text-left">
                                                <label class="text-muted">First Name *</label>
                                                <input class="form-control" type="text" placeholder="Enter your name" name="emp_name" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="text-left">
                                                <label class="text-muted">Last Name</label>
                                                <input class="form-control" type="text" placeholder="Enter your Surname" name="emp_surname">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="text-left">
                                                <label class="text-muted">Email ID *</label>
                                                <input class="form-control" type="text" placeholder="Enter your email address" name="email" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="text-left">
                                                <label class="text-muted">Password *</label>
                                                <input class="form-control" type="password" placeholder="Enter a password" name="password" required>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <div class="text-left">
                                                <label class="text-muted">Address</label>
                                                <textarea class="form-control" name="address" placeholder="Enter your address"></textarea>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-sm-1"></div>
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <div class="text-left">
                                                <label class="text-muted">Phone Number</label>
                                                <input class="form-control" type="text" placeholder="Enter your phone number" name="contact1">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Upload Pic</label>
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
                                <a class="btn btn-warning" href="<?php echo $link->link('admin', frontend); ?>"><i class="fa fa-times"></i> Cancel</a>
                                <button class="btn btn-success" type="submit" name="submit_user"><i class="fa fa-save"></i> Submit</button>

                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>