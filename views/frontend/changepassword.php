<div id="content-container">
          <div class="pageheader">
                        <h3><i class="fa fa-home"></i><?php echo $lang['change_password']; ?></h3>
                        <div class="breadcrumb-wrapper">
                            <span class="label"><?php echo $lang['you_are_here']; ?>:</span>
                            <ol class="breadcrumb">
                                <li> <a href="<?php echo $link->link('home',frontend);?>"> <?php echo $lang['dashboard']; ?> </a> </li>
                                <li class="active"><?php echo $lang['change_password']; ?></li>
                            </ol>
                        </div>
                    </div>
                     <div id="page-content">
                        <div class="row">
                         <?php echo $display_msg;?>
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
                                            <h3 class="panel-title"><?php echo $lang['change_password']; ?></h3>
                                        </div>
                                      <form method="post" action="<?php $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
                                      <input type="hidden" name="profilesize" id="profilesize" >
                                            <div class="panel-body">
                                                <div class="row">

                                                    <div class="col-sm-5">
                                                        <div class="form-group">
                                                            <label class="control-label"><?php echo $lang['old_password']; ?></label>
                                                       <input class="form-control"  name="oldpassword" type="password" value="">

                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label"><?php echo $lang['new_password']; ?></label>
                                                             <input class="form-control"  name="newpassword" type="password" value="">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label"><?php echo $lang['confirm_password']; ?></label>
                                                             <input class="form-control"  name="confirmpassword" type="password" value="">
                                                        </div>

</div>
                                                </div>
                                            </div>
                                            <div class="panel-footer text-right">
                                                <button class="btn btn-info" type="submit" name="submit_changepassword"><?php echo $lang['submit']; ?></button>
                                            </div>
                                        </form>
                                     </div>
                                </div>

                            </div>
                        </div>

                    </div>
</div>>
