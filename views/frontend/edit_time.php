<style type="text/css">
  .chosen-container {
    margin-bottom: 0px;
  }
</style>
<!-- <link href="<?php echo SITE_URL; ?>/assets/frontend/js/report_buttons/buttons.dataTables.min.css" rel="stylesheet" type="text/css" /> -->
<div id="content-container">
  <div class="pageheader">
    <h3><i></i> <?php echo ucfirst($company_details['company_name']); ?> - <?php echo $lang['edit_time']; ?></h3>
    <div class="breadcrumb-wrapper">
      <span class="label"><?php echo $lang['you_are_here']; ?>:</span>
      <ol class="breadcrumb">
        <li class="active"><?php echo $lang['edit_time']; ?></li>
      </ol>
    </div>
  </div>

  <div id="page-content">
    <br>
    <div class="row">
      <?php echo $display_msg; ?>
      <div class="col-lg-12">
        <form method="POST" class="form-horizontal" action="">
          <input type="hidden" name="today" value="none">
          <input type="hidden" name="seven_day" value="none">
          <input type="hidden" name="thirty_day" value="none">
          <input type="hidden" name="sixty_day" value="none">
          <div class="col-lg-5">
            <div class="form-group">
              <label class="control-label col-md-4"><?php echo $lang['start_date']; ?> <br>(YYYY-MM-DD)</label>
              <div class="col-md-8">
                <div class="input-group date datepicker">
                  <input class="form-control" type="text" name="start_date" value="<?php
                                                                                    if ($start_date != '') {
                                                                                      echo $start_date;
                                                                                    } else {
                                                                                      echo  $feature->convertTimeZone(date("Y-m-d"), 'appdate');
                                                                                    }
                                                                                    ?>">
                  <span class="input-group-addon">
                    <i class="fa fa-calendar fa-lg"></i></span>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-5">
            <div class="form-group">
              <label class="control-label col-md-4"><?php echo $lang['end_date']; ?> <br>(YYYY-MM-DD)</label>
              <div class="col-md-8">
                <div class="input-group date datepicker">
                  <input class="form-control" type="text" name="end_date" value="<?php
                                                                                  if ($end_date != '') {
                                                                                    echo $end_date;
                                                                                  } else {
                                                                                    echo  $feature->convertTimeZone(date("Y-m-d"), 'appdate');
                                                                                  }
                                                                                  ?>">
                  <span class="input-group-addon">
                    <i class="fa fa-calendar fa-lg"></i></span>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-2">
            <button class="btn btn-info" type="submit" name="show_data"><?php echo $lang['show']; ?></button>
          </div>

        </form>
      </div>

      <div class="col-lg-12">
        <div class="col-lg-2"></div>
        <div class="col-lg-9">
          <a href="<?php echo $link->link("edit_time", frontend, '&today'); ?>">
            <button class="btn btn-primary" <?php if (isset($_REQUEST['today']) && $_REQUEST['today'] != "none") { ?>disabled<?php } ?> style="padding: 6px 55px;margin: 0 5px 5px 0;"><?php echo $lang['today']; ?></button>
          </a>
          <a href="<?php echo $link->link("edit_time", frontend, '&seven_day'); ?>">
            <button class="btn btn-primary" <?php if (isset($_REQUEST['seven_day']) && $_REQUEST['seven_day'] != "none") { ?>disabled<?php } ?> style="padding: 6px 55px;margin: 0 5px 5px 0;"><?php echo $lang['last_7_days']; ?></button>
          </a>
          <a href="<?php echo $link->link("edit_time", frontend, '&thirty_day'); ?>">
            <button class="btn btn-primary" <?php if (isset($_REQUEST['thirty_day']) && $_REQUEST['thirty_day'] != "none") { ?>disabled<?php } ?> style="padding: 6px 55px;margin: 0 5px 5px 0;"><?php echo $lang['last_30_days']; ?></button>
          </a>
          <a href="<?php echo $link->link("edit_time", frontend, '&sixty_day'); ?>">
            <button class="btn btn-primary" <?php if (isset($_REQUEST['sixty_day']) && $_REQUEST['sixty_day'] != "none") { ?>disabled<?php } ?> style="padding: 6px 55px;margin: 0 5px 5px 0;"><?php echo $lang['last_60_days']; ?></button>
          </a>
        </div>
      </div>

    </div>
    <br>
    <div class="panel">
      <div class="edit_data_container"></div>
      <!-- <div class="panel-heading">
      <h3 class="panel-title">List of all working hours</h3>
      </div> -->

      <div class="panel-body">
        <!-- <table id="demo-dt-basic" class="table table-striped table-bordered"> -->
        <table id="company_report" class="table table-striped table-bordered">
          <thead>
            <tr>
              <th> <?php echo $lang['employee']; ?> </th>
              <th> <?php echo $lang['date']; ?> </th>
              <th> <?php echo $lang['start_time']; ?> </th>
              <th> <?php echo $lang['end_time']; ?> </th>
              <th> <?php echo $lang['break_time']; ?> </th>
              <th class="min-tablet"> <?php echo $lang['total_working_time']; ?> (HH:MM:SS)</th>
              <th> <?php echo $lang['action']; ?> </th>
            </tr>
          </thead>
          <tbody>
            <?php if (is_array($report_details)) {
              foreach ($report_details as $task) {
                $edit_class = '';
                if ($task['cron_edit'] == 1) {
                  $edit_class = 'warning';
                }
                if ($task['manual_edit'] == 1) {
                  $edit_class = 'info';
                }
            ?>
                <tr class="entry_id_<?php echo $task['id']; ?>  <?php echo $edit_class; ?>">
                  <td><?php echo $task['emp_name']; ?></td>
                  <td class="entry_date_<?php echo $task['id']; ?>"><?php echo $task['current_dt']; ?></td>
                  <td class="entry_checkin_<?php echo $task['id']; ?>"><?php echo $feature->convertTimeZone(date("Y-m-d H:i:s", $task['check_in']), 'time'); ?></td>
                  <td class="entry_checkout_<?php echo $task['id']; ?>"><?php if ($task['check_out'] != '') echo $feature->convertTimeZone(date("Y-m-d H:i:s", $task['check_out']), 'time'); ?></td>
                  <td><?php if ($task['check_out'] != '' && ($task['check_out'] - $task['check_in'] >= $task['working_hours'])) {
                        echo gmdate("H:i:s", ($task['check_out'] - $task['check_in'] - $task['working_hours']));
                      } ?></td>
                  <td class="entry_wh_<?php echo $task['id']; ?>"><?php if ($task['working_hours'] != '') echo gmdate("H:i:s", $task['working_hours']); ?></td>
                  <td>
                    <?php if ($task['current_dt'] != date('Y-m-d')) { ?>
                      <button class="btn btn-success entry_edit_button" data-id="<?php echo $task['id']; ?>" data-toggle="modal" data-target="#editForm"><i class="fa fa-edit"></i></button>
                      <button class="btn btn-danger entry_delete_button" data-id="<?php echo $task['id']; ?>" data-toggle="modal" data-target="#deleteForm"><i class="fa fa-trash"></i></button>
                    <?php } ?>
                  </td>
                </tr>
            <?php
              }
            } ?>
          </tbody>
        </table>
      </div>

    </div>
  </div>
</div>

<div class="modal fade" id="editForm" tabindex="-1" role="dialog" aria-labelledby="editFormLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body row">
        <div class="col-lg-12">
          <div class="col-lg-12 edit_error text-center" style="color: red; margin-bottom: 10px;">
            <?php echo $lang['provide_all_valid_details']; ?>
          </div>
          <form method="POST" class="form-horizontal" action="">

            <div class="col-lg-12">
              <div class="form-group">
                <label class="control-label col-md-4"><?php echo $lang['date']; ?> (YYYY-MM-DD)</label>
                <div class="col-md-8">
                  <div class="input-group date datepicker">
                    <input class="form-control edit_date" type="text" name="edit_date" value="">
                    <span class="input-group-addon">
                      <i class="fa fa-calendar fa-lg"></i></span>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-12">
              <div class="form-group">
                <label class="control-label col-md-4"><?php echo $lang['start_time']; ?></label>
                <div class="col-md-8">
                  <div class="input-group ">
                    <input class="form-control datetimepicker edit_checkin" type="text" name="edit_checkin" value="">
                    <span class="input-group-addon">
                      <i class="fa fa-clock-o fa-lg"></i></span>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-12">
              <div class="form-group">
                <label class="control-label col-md-4"><?php echo $lang['end_time']; ?></label>
                <div class="col-md-8">
                  <div class="input-group ">
                    <input class="form-control datetimepicker edit_checkout" type="text" name="edit_checkout" value="">
                    <span class="input-group-addon">
                      <i class="fa fa-clock-o fa-lg"></i></span>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-12">
              <div class="form-group">
                <div class="col-md-12 text-right">
                  <input type="hidden" name="edit_entry_id" class="edit_entry_id" value="" />
                  <button type="button" class="btn btn-warning" data-dismiss="modal"><?php echo $lang['cancel']; ?></button> &nbsp;&nbsp;
                  <button type="button" class="btn btn-primary edit_data"><?php echo $lang['submit']; ?></button>
                </div>
              </div>
            </div>

          </form>
        </div>
      </div>
      <!-- <div class="modal-footer">
      </div> -->
    </div>
  </div>
</div>

<div class="modal fade" id="deleteForm" tabindex="-1" role="dialog" aria-labelledby="deleteFormLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <?php echo $lang['are_you_sure']; ?>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="delete_entry_id" class="delete_entry_id" value="" />
        <button type="button" class="btn btn-warning" data-dismiss="modal"><?php echo $lang['close']; ?></button>
        <button type="button" class="btn btn-danger delete_confirm"><?php echo $lang['save_changes']; ?></button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addForm" tabindex="-1" role="dialog" aria-labelledby="addFormLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body row">
        <div class="col-lg-12">
          <div class="col-lg-12 add_error text-center" style="color: red; margin-bottom: 10px;">
            <?php echo $lang['provide_all_valid_details']; ?>
          </div>
          <form method="POST" id="add_form" class="form-horizontal" action="">

            <div class="col-lg-12">
              <div class="form-group">
                <label class="control-label col-md-4"><?php echo $lang['employee']; ?></label>
                <div class="col-md-8">
                  <div class="input-group">
                    <select name="add_employee" class="form-control add_employee demo-chosen-select">
                      <option value="0"><?php echo $lang['select_employee']; ?></option>
                      <?php
                      if (is_array($emp_details)) {
                        foreach ($emp_details as $emp) { ?>
                          <option value="<?php echo $emp["employee_id"]; ?>"><?php echo $emp["emp_name"]; ?></option>
                      <?php }
                      } ?>
                    </select>
                    <span class="input-group-addon"><i class="fa fa-user fa-lg"></i></span>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-12">
              <div class="form-group">
                <label class="control-label col-md-4"><?php echo $lang['date']; ?> (YYYY-MM-DD)</label>
                <div class="col-md-8">
                  <div class="input-group date datepicker1">
                    <input class="form-control add_date" type="text" name="add_date" value="">
                    <span class="input-group-addon">
                      <i class="fa fa-calendar fa-lg"></i></span>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-12">
              <div class="form-group">
                <label class="control-label col-md-4"><?php echo $lang['start_time']; ?></label>
                <div class="col-md-8">
                  <div class="input-group ">
                    <input class="form-control datetimepicker add_checkin" type="text" name="add_checkin" value="">
                    <span class="input-group-addon">
                      <i class="fa fa-clock-o fa-lg"></i></span>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-12">
              <div class="form-group">
                <label class="control-label col-md-4"><?php echo $lang['end_time']; ?></label>
                <div class="col-md-8">
                  <div class="input-group ">
                    <input class="form-control datetimepicker add_checkout" type="text" name="add_checkout" value="">
                    <span class="input-group-addon">
                      <i class="fa fa-clock-o fa-lg"></i></span>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-12">
              <div class="form-group">
                <div class="col-md-12 text-right">
                  <button type="button" class="btn btn-warning" data-dismiss="modal"><?php echo $lang['cancel']; ?></button> &nbsp;&nbsp;
                  <button type="button" class="btn btn-primary add_data"><?php echo $lang['submit']; ?></button>
                </div>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- <script type="text/javascript" src="<?php echo SITE_URL; ?>/assets/frontend/js/report_buttons/jquery.dataTables.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo SITE_URL; ?>/assets/frontend/js/report_buttons/dataTables.tableTools.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL; ?>/assets/frontend/js/report_buttons/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL; ?>/assets/frontend/js/report_buttons/buttons.flash.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL; ?>/assets/frontend/js/report_buttons/jszip.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL; ?>/assets/frontend/js/report_buttons/pdfmake.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL; ?>/assets/frontend/js/report_buttons/vfs_fonts.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL; ?>/assets/frontend/js/report_buttons/buttons.html5.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL; ?>/assets/frontend/js/report_buttons/buttons.print.min.js"></script> -->

<script type="text/javascript">
  $(document).ready(function() {
    $('#company_report').DataTable({
      "dom": "<'row'<'col-md-2'l><'col-md-8'Bf><'col-md-2 add_entry_container'>>" + "<'row'<'col-md-6'><'col-md-6'>>" + "<'row'<'col-md-12't>><'row'<'col-md-6'i><'col-md-6'p>>",
      initComplete: function() {
        $("div.add_entry_container").html('<button type="button" class="btn btn-warning add_entry" data-toggle="modal" data-target="#addForm" ><i class="fa fa-plus-square"></i>  <?php echo $lang['add_entry']; ?></button>');
      },
      buttons: [
        'csv', 'excel', 'print'
      ],
      "responsive": true,
      "language": {
        "paginate": {
          "previous": '<i class="fa fa-angle-left"></i>',
          "next": '<i class="fa fa-angle-right"></i>'
        }
      },
      "oLanguage": {
        'sUrl': '//cdn.datatables.net/plug-ins/1.10.19/i18n/<?php echo $_SESSION['site_lang']; ?>.json'
      }
    });

    // $("div.add_entry_container").html('<button type="button" class="btn btn-warning add_entry" data-toggle="modal" data-target="#addForm" ><i class="fa fa-plus-square"></i>  <?php echo $lang['add_entry']; ?></button>');

    $('.datetimepicker').datetimepicker({
      format: 'HH:mm:ss'
    });

    $('.entry_edit_button').click(function() {
      var entry_id = $(this).attr('data-id');
      var edit_date = $('.entry_date_' + entry_id).text();
      var edit_checkin = $('.entry_checkin_' + entry_id).text();
      var edit_checkout = $('.entry_checkout_' + entry_id).text();
      $('.edit_entry_id').val(entry_id);
      $('.edit_date').val(edit_date);
      $('.edit_checkin').val(edit_checkin);
      $('.edit_checkout').val(edit_checkout);
    });

    $('.entry_delete_button').click(function() {
      var entry_id = $(this).attr('data-id');
      $('.delete_entry_id').val(entry_id);
    });

    $('.edit_data').click(function() {
      var entry_id = $('.edit_entry_id').val();
      var edit_date = $('.edit_date').val();
      var edit_checkin = $('.edit_checkin').val();
      var edit_checkout = $('.edit_checkout').val();
      var url = '<?php echo $link->link("edit_data"); ?>';
      var time1 = new Date(edit_date + ' ' + edit_checkin);
      var time2 = new Date(edit_date + ' ' + edit_checkout);
      var working_hours = (time2.getTime() - time1.getTime()) / 1000;
      seconds = parseInt(working_hours);
      var w_h = Math.floor(moment.duration(seconds, 'seconds').asHours()) + ':' + moment.duration(seconds, 'seconds').minutes() + ':' + moment.duration(seconds, 'seconds').seconds();

      if (entry_id > 0 && edit_date != '' && edit_checkin != '' && edit_checkout != '00:00:00') {
        $.ajax({
          url: url,
          method: 'post',
          data: {
            edit_type: 'shift_data',
            entry_id: entry_id,
            edit_date: edit_date,
            edit_checkin: edit_checkin,
            edit_checkout: edit_checkout,
          },
          success: function(res) {
            if (res == 1) {
              var shtml = '<div class="alert alert-success"><i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button><?php echo $lang['update_success']; ?></div>';
              $('.edit_data_container').html(shtml);
              $('.entry_id_' + entry_id).addClass('info');
              $('.entry_date_' + entry_id).text(edit_date);
              $('.entry_checkin_' + entry_id).text(edit_checkin);
              $('.entry_checkout_' + entry_id).text(edit_checkout);
              $('.entry_wh_' + entry_id).text(w_h);
              $('#editForm').modal('hide');
            }
          },
          error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
          }
        });
      } else {
        $('.edit_error').show();
      }
    });

    $('.add_data').click(function() {
      // var company_id = $('#company_select').val();
      var company_id = '<?php echo $_SESSION["company_id"] ?>';
      var employee_id = $('.add_employee').val();
      var add_date = $('.add_date').val();
      var add_checkin = $('.add_checkin').val();
      var add_checkout = $('.add_checkout').val();
      var url = '<?php echo $link->link("edit_data"); ?>';
      if (company_id > 0 && employee_id > 0 && add_date != '' && add_checkin != '') {
        $.ajax({
          url: url,
          method: 'post',
          data: {
            edit_type: 'shift_data_add',
            company_id: company_id,
            employee_id: employee_id,
            add_date: add_date,
            add_checkin: add_checkin,
            add_checkout: add_checkout,
          },
          success: function(res) {
            if (res == 1) {
              location.reload();
            }
          },
          error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
          }
        });
      } else {
        $('.add_error').show();
      }
    });

    $('.delete_confirm').click(function() {
      var url = '<?php echo $link->link("edit_data"); ?>';
      var entry_id = $('.delete_entry_id').val();
      $.ajax({
        url: url,
        method: 'post',
        data: {
          edit_type: 'shift_data_delete',
          entry_id: entry_id,
        },
        success: function(res) {
          if (res == 1) {
            var shtml = '<div class="alert alert-success"><i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button><?php echo $lang['delete_success']; ?></div>';
            $('.edit_data_container').html(shtml);
            $('.entry_id_' + entry_id).remove();
            $('#deleteForm').modal('hide');
          }
        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.log(textStatus, errorThrown);
        }
      });
    });

  });

  $(function() {
    $('#editForm').on('show.bs.modal', function(e) {
      $('.edit_error').hide();
    });

    $('#addForm').on('show.bs.modal', function(e) {
      $('.add_error').hide();
      // $('#add_form')[0].reset();
    });
  });
</script>