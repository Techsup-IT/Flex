<?php
function sec2hms($secs)
{
  $secs = round($secs);
  $secs = abs($secs);
  $hours = floor($secs / 3600) . ':';
  if ($hours == '0:') $hours = '';
  $minutes = substr('00' . floor(($secs / 60) % 60), -2) . ':';
  $seconds = substr('00' . $secs % 60, -2);
  return ltrim($hours . $minutes . $seconds, '0');
}
function sec2hms_new($seconds)
{
  $t = round($seconds);
  return sprintf('%02d:%02d:%02d', ($t / 3600), ($t / 60 % 60), $t % 60);
}
?>
<!-- <link href="<?php echo SITE_URL; ?>/assets/frontend/js/report_buttons/buttons.dataTables.min.css" rel="stylesheet" type="text/css" /> -->
<div id="content-container">
  <div class="pageheader">
    <h3><i><img src="uploads/logo/company_icons/icons_flex-14.png" style ="width:40px;height:40px;"></i> <?php echo ucfirst($company_details['company_name']); ?> - <?php echo $lang['report']; ?></h3>
    <div class="breadcrumb-wrapper">
      <span class="label"><?php echo $lang['you_are_here']; ?>:</span>
      <ol class="breadcrumb">
        <li class="active"><?php echo $lang['report']; ?></li>
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
          <a href="<?php echo $link->link("reports", frontend, '&today'); ?>">
            <button class="btn btn-primary" <?php if (isset($_REQUEST['today']) && $_REQUEST['today'] != "none") { ?>disabled<?php } ?> style="padding: 6px 55px;margin: 0 5px 5px 0;"><?php echo $lang['today']; ?></button>
          </a>
          <a href="<?php echo $link->link("reports", frontend, '&seven_day'); ?>">
            <button class="btn btn-primary" <?php if (isset($_REQUEST['seven_day']) && $_REQUEST['seven_day'] != "none") { ?>disabled<?php } ?> style="padding: 6px 55px;margin: 0 5px 5px 0;"><?php echo $lang['last_7_days']; ?></button>
          </a>
          <a href="<?php echo $link->link("reports", frontend, '&thirty_day'); ?>">
            <button class="btn btn-primary" <?php if (isset($_REQUEST['thirty_day']) && $_REQUEST['thirty_day'] != "none") { ?>disabled<?php } ?> style="padding: 6px 55px;margin: 0 5px 5px 0;"><?php echo $lang['last_30_days']; ?></button>
          </a>
          <a href="<?php echo $link->link("reports", frontend, '&sixty_day'); ?>">
            <button class="btn btn-primary" <?php if (isset($_REQUEST['sixty_day']) && $_REQUEST['sixty_day'] != "none") { ?>disabled<?php } ?> style="padding: 6px 55px;margin: 0 5px 5px 0;"><?php echo $lang['last_60_days']; ?></button>
          </a>
        </div>
      </div>

    </div>
    <br>
    <div class="panel">
      <!-- <div class="panel-heading">
      <h3 class="panel-title">List of all working hours</h3>
      </div> -->

      <div class="panel-body">
        <!-- <table id="demo-dt-basic" class="table table-striped table-bordered"> -->
        <table id="company_report" class="table table-striped table-bordered">
          <thead>
            <tr>
              <th> <?php echo $lang['employee']; ?> </th>
              <th> <?php echo $lang['project']; ?> </th>
              <th> <?php echo $lang['task']; ?> </th>

              <?php if ($_SESSION['department'] == 4 || $_SESSION['department'] == 5) { ?>
                <th> <?php echo $lang['date']; ?> </th>
                <th> <?php echo $lang['start_time']; ?> </th>
                <th> <?php echo $lang['end_time']; ?> </th>
              <?php } ?>

              <th class="min-tablet text-right"> <?php echo $lang['total_working_time']; ?> (HH:MM:SS)</th>
              <th> <?php echo $lang['approved_hours']; ?> </th>
              <th> <?php echo $lang['rejected_hours']; ?> </th>

              <?php if ($_SESSION['department'] == 3) { ?>
                <th class="text-right"> <?php echo $lang['compute_wages']; ?> </th>
              <?php } ?>

              <?php if ($_SESSION['department'] == 4 || $_SESSION['department'] == 5) { ?>
                <th> <?php echo $lang['action']; ?> </th>
              <?php } ?>

            </tr>
          </thead>
          <tbody>
            <?php if (is_array($report_details)) {
              foreach ($report_details as $task) { ?>
                <tr class="entry_id_<?php echo $task['id']; ?>"" >
                  <td><?php echo $task['emp_name']; ?></td>
                  <?php
                  if ($task['project_name'] == '') {
                    $default_project = $db->run("SELECT p.project_id, p.project_name, t.task_name FROM projects p LEFT JOIN project_assign pa on (pa.project_id = p.project_id) LEFT JOIN to_do_list t on t.project_id = p.project_id WHERE p.company_id = '" . $_SESSION['company_id'] . "' and p.project_type != 'public' and (p.employee_id = '" . $task['employee_id'] . "' or p.share_project_to = '" . $task['employee_id'] . "' or pa.employee_id = '" . $task['employee_id'] . "') ORDER BY p.created_date DESC")->fetchAll();
                    if (!empty($default_project)) {
                      $default_project = $default_project[0];
                      $task['project_name'] = $default_project['project_name'];
                      $task['task_name'] = $default_project['task_name'];
                    }
                  }
                  ?>
                  <td><?php echo $task['project_name']; ?></td>
                  <td><?php echo $task['task_name']; ?></td>

                  <?php if ($_SESSION['department'] == 4 || $_SESSION['department'] == 5) { ?>
                    <td><?php echo $task['current_dt']; ?></td>
                    <td><?php echo $feature->convertTimeZone(date("Y-m-d H:i:s", $task['check_in']), 'time'); ?></td>
                    <td><?php if ($task['check_out'] != '') echo $feature->convertTimeZone(date("Y-m-d H:i:s", $task['check_out']), 'time'); ?></td>
                  <?php } ?>
                  
                  <td class=" text-right entry_wh_<?php echo $task['id']; ?>"><?php echo sec2hms_new($task['working_hours']); ?></td>
                  <td class="text-right"><?php echo sec2hms_new($task['approved_time']); ?></td>
                  <td class="text-right"><?php echo sec2hms_new($task['working_hours'] - $task['approved_time']); ?></td>

                  <?php if ($_SESSION['department'] == 3) { ?>
                    <td class="text-right">
                      <?php
                      $compute_wages = 0;
                      if ($task['hourly_rate'] != '' && $task['hourly_rate'] > 0) {
                        $compute_wages =  $task['approved_time'] * ($task['hourly_rate'] / 3600);
                      }
                      echo number_format((float)$compute_wages, 2) . " $";
                      ?>
                    </td>
                  <?php } ?>

                  <?php if ($_SESSION['department'] == 4 || $_SESSION['department'] == 5) { ?>
                    <td>
                      <button class="btn btn-success entry_edit_button" data-id="<?php echo $task['id']; ?>" data-toggle="modal" data-target="#editForm"><i class="fa fa-edit"></i></button>
                    </td>
                  <?php } ?>

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
          <div class="col-lg-12 edit_error text-center" style="display: none; color: red; margin-bottom: 10px;">
            <?php echo $lang['time_diff_error']; ?>
          </div>
          <form method="POST" class="form-horizontal" id="edit_form" action="<?php $link->link("reports", frontend); ?>">

            <div class="col-lg-12">
              <div class="form-group">
                <label class="control-label col-md-4"><?php echo $lang['total_working_time']; ?></label>
                <div class="col-md-8">
                  <input class="form-control total_working_time" type="text" name="total_working_time" disabled readonly>
                </div>
              </div>
            </div>

            <div class="col-lg-12">
              <div class="form-group">
                <label class="control-label col-md-4"><?php echo $lang['approved_hours']; ?></label>
                <div class="col-md-8">
                  <input class="form-control approved_time datetimepicker" type="text" name="approved_time">
                </div>
              </div>
            </div>

            <div class="col-lg-12">
              <div class="form-group">
                <div class="col-md-12 text-right">
                  <input type="hidden" name="edit_entry_id" class="edit_entry_id" />
                  <button type="button" class="btn btn-warning" data-dismiss="modal"><?php echo $lang['cancel']; ?></button> &nbsp;&nbsp;
                  <button type="submit" name="approve_time_submit" class="btn btn-primary"><?php echo $lang['submit']; ?></button>
                </div>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $('#company_report').DataTable({
      "dom": "<'row'<'col-md-4'l><'col-md-8'Bf>>" + "<'row'<'col-md-6'><'col-md-6'>>" + "<'row'<'col-md-12't>><'row'<'col-md-6'i><'col-md-6'p>>",
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

    $('.datetimepicker').datetimepicker({
      format: 'HH:mm:ss'
    });

    $('.entry_edit_button').click(function() {
      var entry_id = $(this).attr('data-id');
      var edit_wh = $('.entry_wh_' + entry_id).text();
      $('.edit_entry_id').val(entry_id);
      $('.total_working_time').val(edit_wh);
      $('.approved_time').val(edit_wh);
    });

    $('#edit_form').submit(function() {
      $('.edit_error').hide();
      var total_time = $('.total_working_time').val();
      var approved_time = $('.approved_time').val();
      var total_time_sec = total_time.split(':').reduce((acc, time) => (60 * acc) + +time);
      var approved_time_sec = approved_time.split(':').reduce((acc, time) => (60 * acc) + +time);
      if (approved_time_sec > total_time_sec) {
        $('.edit_error').show();
        return false;
      }
      return true;
    });
  });
</script>