<!-- <link href="<?php echo SITE_URL; ?>/assets/frontend/js/report_buttons/buttons.dataTables.min.css" rel="stylesheet" type="text/css" /> -->
<div id="content-container">
  <div class="pageheader">
    <h3><i><img src="uploads/logo/company_icons/icons_flex-16.png" style ="width:50px;height:50px;"></i> <?php echo ucfirst($company_details['company_name']); ?> - <?php echo $lang['attendance_report']; ?></h3>
    <div class="breadcrumb-wrapper">
      <span class="label"><?php echo $lang['you_are_here']; ?>:</span>
      <ol class="breadcrumb">
        <li class="active"><?php echo $lang['attendance_report']; ?></li>
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
          <a href="<?php echo $link->link("attendance", frontend, '&today'); ?>">
            <button class="btn btn-primary" <?php if (isset($_REQUEST['today']) && $_REQUEST['today'] != "none") { ?>disabled<?php } ?> style="padding: 6px 55px;margin: 0 5px 5px 0;"><?php echo $lang['today']; ?></button>
          </a>
          <a href="<?php echo $link->link("attendance", frontend, '&seven_day'); ?>">
            <button class="btn btn-primary" <?php if (isset($_REQUEST['seven_day']) && $_REQUEST['seven_day'] != "none") { ?>disabled<?php } ?> style="padding: 6px 55px;margin: 0 5px 5px 0;"><?php echo $lang['last_7_days']; ?></button>
          </a>
          <a href="<?php echo $link->link("attendance", frontend, '&thirty_day'); ?>">
            <button class="btn btn-primary" <?php if (isset($_REQUEST['thirty_day']) && $_REQUEST['thirty_day'] != "none") { ?>disabled<?php } ?> style="padding: 6px 55px;margin: 0 5px 5px 0;"><?php echo $lang['last_30_days']; ?></button>
          </a>
          <a href="<?php echo $link->link("attendance", frontend, '&sixty_day'); ?>">
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
              <th> <?php echo $lang['date']; ?> </th>
              <th> <?php echo $lang['start_time']; ?> </th>
              <th> <?php echo $lang['end_time']; ?> </th>
              <th> <?php echo $lang['break_time']; ?> </th>
              <th class="min-tablet"> <?php echo $lang['total_working_time']; ?> (HH:MM:SS)</th>
              <th> <?php echo $lang['checkin_count']; ?> </th>
              <!-- <th> <?php echo $lang['action']; ?> </th> -->
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
                <tr class="<?php echo $edit_class; ?>">
                  <td><?php echo $task['emp_name']; ?></td>
                  <td><?php echo $task['current_dt']; ?></td>
                  <!-- <td><?php echo date('Y-m-d H:i:s', $task['check_in']); ?></td>
                <td><?php echo date('Y-m-d H:i:s', $task['check_out']); ?></td> -->
                  <!-- <td><?php echo gmdate("H:i:s", $task['check_in']); ?></td>
                <td><?php echo gmdate("H:i:s", $task['check_out']); ?></td> -->
                  <td><?php echo $feature->convertTimeZone(date("Y-m-d H:i:s", $task['check_in']), 'time'); ?></td>
                  <td><?php if ($task['check_out'] != '') echo $feature->convertTimeZone(date("Y-m-d H:i:s", $task['check_out']), 'time'); ?></td>
                  <td><?php if ($task['check_out'] != '' && ($task['check_out'] - $task['check_in'] >= $task['working_hours'])) {
                        echo gmdate("H:i:s", ($task['check_out'] - $task['check_in'] - $task['working_hours']));
                      } ?></td>
                  <td><?php echo gmdate("H:i:s", $task['working_hours']); ?></td>
                  <td><?php echo $task['checkin_count']; ?></td>
                  <?php
                  $activity_link = $link->link('activity_list', frontend, '&date=' . $task['current_dt'] . '&emp=' . $task['employee_id']);
                  ?>
                  <!-- <td><a href="<?php echo $activity_link; ?>" target="_blank" class="btn btn-success"><?php echo $lang['screenshots']; ?></a></td> -->
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
  });
</script>