<div id="content-container">
  <div class="pageheader hidden-xs">
    <h3><i></i><?php echo $lang['add_user']; ?></h3>
    <div class="breadcrumb-wrapper">
      <span class="label"><?php echo $lang['you_are_here']; ?>:</span>
      <ol class="breadcrumb">
        <li> <a href="<?php echo $link->link('users', frontend); ?>"><?php echo $lang['view_user']; ?> </a> </li>
        <li class="active"><?php echo $lang['add_user']; ?></li>
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
              <h3 class="panel-title"><?php echo $lang['add_new_user']; ?></h3>
            </div>
            <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
              <input type="hidden" name="profilesize" id="profilesize">
              <div class="panel-body">
                <div class="row">
                  <div class="col-sm-5">

                    <div class="form-group">
                      <div class="text-left">
                        <label class="text-muted"><?php echo $lang['IdNumber']; ?></label>
                        <input class="form-control" type="text" placeholder="<?php echo $lang['enter_your_IdNumber']; ?> *" name="IdNumber" required="required">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="text-left">
                        <label class="text-muted"><?php echo $lang['EstLaborOfficeId']; ?></label>
                        <input class="form-control" type="text" placeholder="<?php echo $lang['enter_your_EstLaborOfficId']; ?> *" name="EstLaborOfficeId" required="required">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="text-left">
                        <label class="text-muted"><?php echo $lang['EstSequenceNumber']; ?></label>
                        <input class="form-control" type="text" placeholder="<?php echo $lang['enter_your_EstSequenceNumber']; ?> *" name="EstSequenceNumber" required="required">
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="text-left">
                        <label class="text-muted"><?php echo $lang['first_name']; ?></label>
                        <input class="form-control" type="text" placeholder="<?php echo $lang['enter_your_name']; ?> *" name="emp_name">
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
                        <label class="text-muted"><?php echo $lang['email_id']; ?></label>
                        <input class="form-control" type="text" placeholder="<?php echo $lang['enter_your_email_address']; ?> *" name="email">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="text-left">
                        <label class="text-muted"><?php echo $lang['password']; ?></label>
                        <input class="form-control" type="password" placeholder="<?php echo $lang['enter_password']; ?> *" name="password">
                      </div>
                    </div>


                    <div class="form-group">
                      <div class="text-left">
                        <label class="text-muted"><?php echo $lang['address']; ?></label>
                        <textarea class="form-control" name="address" placeholder="<?php echo $lang['enter_your_address']; ?>"></textarea>
                      </div>
                    </div>

                    <!-- <div class="form-group">
                      <div><label class="text-muted"><?php echo $lang['is_screenshot_allowed']; ?> </label></div>
                      <div>
                        <ul class="list-inline">
                          <li class="mar-btm">
                            <select name="screenshort" class="form-control " id="allowed">
                              <option value="yes"><?php echo $lang['yes']; ?></option>
                              <option value="no" selected><?php echo $lang['no']; ?></option>
                            </select>
                          </li>
                        </ul>
                      </div>
                    </div> -->

                    <!-- <div class="form-group">
                      <div><label class="text-muted"><?php echo $lang['is_logs_allowed']; ?> </label></div>
                      <ul class="list-inline">
                        <li class="mar-btm">
                          <select name="logs" class="form-control " id="allowed">
                            <option value="yes"><?php echo $lang['yes']; ?></option>
                            <option value="no"><?php echo $lang['no']; ?></option>
                          </select>
                        </li>
                      </ul>
                    </div> -->

                    <div class="form-group">
                      <div><label class="text-muted"><?php echo $lang['is_mol_TWC']; ?> </label></div>
                      <ul class="list-inline">
                        <li class="mar-btm">
                          <select name="is_molTWC" class="form-control " id="allowed">
                            <option value="0"><?php echo $lang['no']; ?></option>
                            <option value="1"><?php echo $lang['yes']; ?></option>
                          </select>
                        </li>
                      </ul>
                    </div>
                    <!-- <div class="form-group">
                      <div>
                        <?php echo $lang['salary_type']; ?>
                      </div>
                      <div>
                        <select name="salary_type" class="form-control" id="salary_type_spt" onchange="fucSalaryType()" working_hours="<?php echo $get_row['hour']; ?>">
                          <option value="salaried"><?php echo $lang['salaried']; ?></option>
                          <option value="hourly"><?php echo $lang['hourly']; ?></option>
                        </select>
                      </div>
                    </div> -->
                    <!-- <div class="form-group">
                      <div>
                        <?php echo $lang['amount']; ?>*
                      </div>
                      <div>
                        <input class="form-control" type="text" placeholder="00.00" name="salary" id="salary">
                      </div>
                    </div> -->
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
                      <label class="control-label"><?php echo $lang['country']; ?> &nbsp;&nbsp;&nbsp;<i class="fa fa-question-circle add-tooltip" data-placement="right" data-toggle="tooltip" data-original-title="Country will be auto filled once this user installs TimeNox Software"></i></label>
                      <select class="form-control " name="country" disabled>
                        <option value="" label="None" selected="selected"><?php echo $lang['select_a_country']; ?> </option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label class="control-label"><?php echo $lang['no_of_working_hour']; ?> </label>
                      <input class="form-control" type="number" name="hour">
                      <!-- <select class="form-control " name="hour">
                        <?php for ($i = 0; $i <= 24; $i++) : ?>
                          <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php endfor; ?>
                      </select> -->
                    </div>
                    <div class="form-group">
                      <label class="control-label"><?php echo $lang['upload_pic']; ?></label>
                      <div class="fileupload fileupload-new" data-provides="fileupload">
                        <div class="fileupload-new img-thumbnail">
                          <img src="<?php echo SITE_URL . '/uploads/noimage.png'; ?>" width="100%">
                        </div>
                        <div>
                          <br>
                          <input type="file" name="img">
                        </div>
                        <small>Only jpg , png & jpeg (Max : <?php echo $upload_max_size; ?>)</small>
                      </div>
                    </div>
                  </div>

                </div>
              </div>

              <div class="panel-footer text-center">
                <a class="btn btn-warning" href="<?php echo $link->link('users', frontend); ?>"><i class="fa fa-times"></i> <?php echo $lang['cancel']; ?></a>
                <button class="btn btn-success" type="submit" name="submit_user"><i class="fa fa-save"></i> <?php echo $lang['submit']; ?></button>

              </div>
            </form>
          </div>
        </div>

      </div>
    </div>

  </div>
</div>