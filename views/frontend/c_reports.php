<style type="text/css">
  .bar_container {
    height: 20px;
    margin: 0px 5px;
    border: 1px solid #c5c5c5;
    border-radius: 5px;
  }

  .wh_container {
    height: 18px;
    float: left;
    background: green;
    /*border-radius : 5px 0px 0px 5px;*/
    border-radius: 5px;
  }

  .c_wh_container {
    height: 18px;
    float: left;
    background: green;
    /*border-radius : 5px 0px 0px 5px;*/
    border-radius: 5px;
  }

  .e_wh_container {
    height: 18px;
    float: left;
    background: blue;
    /*border-radius : 5px 0px 0px 5px;*/
    border-radius: 5px;
  }

  .color_box {
    height: 15px;
    width: 15px;
    border: 1px solid;
    float: left;
    padding: 2px;
    margin: 2px;
  }

  .c_box {
    background: green;
  }

  .m_box {
    background: blue;
  }

  .e_box {
    background: yellow;
  }
</style>
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

function getMax($array = array())
{
  $max = 0;
  foreach ($array as $k => $v) {
    $max = max(array($max, $v['working_hours']));
  }
  return $max;
}

function get_bar($w_h = 0, $ewh = 0, $r_t = '', $max_wh = 1)
{
  $w_hours = ($w_h > 0) ? $w_h : 0;
  $e_wh = ($ewh > 0) ? $ewh : 0;
  if ($e_wh > 0) {
    $w_hours -= $e_wh;
  }

  $r_type = ($r_t != '') ? $r_t : 'daily';
  $total_hours = ($max_wh > 0 && ($max_wh / 3600) > 8) ? ($max_wh / 3600) : 8;
  $work_hour = 0;
  $bwh = (($w_hours / 3600) * 100 / $total_hours);
  $bewh = (($e_wh / 3600) * 100 / $total_hours);
  $bar_html = '<div class="bar_container"><div class="wh_container" style="width:' . $bwh . '%;background:blue"></div><div class="e_wh_container" style="width:' . $bewh . '%;background:yellow"></div></div>';
  return $bar_html;
}

?>
<!-- <link href="<?php echo SITE_URL; ?>/assets/frontend/js/report_buttons/buttons.dataTables.min.css" rel="stylesheet" type="text/css" /> -->
<div id="content-container">
  <div class="pageheader">
    <h3><i>
        <?php if ($r_t == 'daily') { ?>
        <img src="uploads/logo/company_icons/icons_flex-18.png" style ="width:50px;height:50px;">
        <?php } ?>
          <?php if ($r_t == 'weekly') { ?>
        <img src="uploads/logo/company_icons/icons_flex-19.png" style ="width:50px;height:50px;">
        <?php } ?>
          <?php if ($r_t == 'monthly') { ?>
        <img src="uploads/logo/company_icons/icons_flex-20.png" style ="width:50px;height:50px;">
        <?php } ?>
        </i> <?php echo ucfirst($company_details['company_name']); ?> - <?php echo $lang[$r_t]; ?> <?php echo $lang['work_summary_report']; ?></h3>
    <div class="breadcrumb-wrapper">
      <span class="label"><?php echo $lang['you_are_here']; ?>:</span>
      <ol class="breadcrumb">
        <li class="active"><?php echo $lang['report']; ?></li>
      </ol>
    </div>
  </div>

  <div id="page-content">
    <div class="row">
      <?php echo $display_msg; ?>
      <div class="col-lg-10">
        <form method="POST" class="form-horizontal" action="">
          <input type="hidden" class="r_t" name="r_t" value="<?php echo $r_t; ?>">
          <div class="col-lg-5">
            <div class="form-group">
              <label class="control-label col-md-4"><?php echo $lang['start_date']; ?> <br>(YYYY-MM-DD)</label>
              <div class="col-md-8">
                <div class="input-group date datepicker">
                  <input class="form-control startDate" type="text" name="start_date" value="<?php
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
                <div class="input-group date">
                  <input readonly class="form-control endDate" type="text" name="end_date" value="<?php
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

      <div class="col-lg-2">
        <?php if ($r_t == 'daily') { ?>
          <a href="<?php echo $link->link("c_reports", frontend, '&daily'); ?>">
            <button class="btn btn-primary" <?php if (isset($is_rt) && $is_rt == "daily") { ?>disabled<?php } ?>><?php echo $lang['today']; ?></button>
          </a>
        <?php } ?>

        <?php if ($r_t == 'weekly') { ?>
          <a href="<?php echo $link->link("c_reports", frontend, '&weekly'); ?>">
            <button class="btn btn-primary" <?php if (isset($is_rt) && $is_rt == "weekly") { ?>disabled<?php } ?>><?php echo $lang['last_7_days']; ?></button>
          </a>
        <?php } ?>

        <?php if ($r_t == 'monthly') { ?>
          <a href="<?php echo $link->link("c_reports", frontend, '&monthly'); ?>">
            <button class="btn btn-primary" <?php if (isset($is_rt) && $is_rt == "monthly") { ?>disabled<?php } ?>><?php echo $lang['last_30_days']; ?></button>
          </a>
        <?php } ?>
      </div>

    </div>
    <br>

    <div class="panel">
      <div class="panel-body">
        <table id="company_report" class="table table-striped table-bordered text-right">
          <thead>
            <tr>
              <th class="text-right"> <?php echo $lang['employee_name']; ?></th>
              <th class="min-tablet text-right"> <?php echo $lang['total_working_time']; ?> (HH:MM:SS)</th>
              <th style="min-width: 250px;">
                <div>
                  <div class="color_box m_box"></div>
                  <div><?php echo $lang['mobile_work_time']; ?></div>
                  <div class="clearfix"></div>
                  <div class="color_box e_box"></div>
                  <div><?php echo $lang['manual_work_time']; ?></div>
                </div>
              </th>
            </tr>
          </thead>
          <tbody>
            <?php if (is_array($report_details)) {
              usort($report_details, function ($item1, $item2) {
                if ($item1['working_hours'] == $item2['working_hours']) return 0;
                return $item1['working_hours'] > $item2['working_hours'] ? -1 : 1;
              });
              $max_wh = getMax($report_details);
              foreach ($report_details as $task) {
                $custom_style = '';
                if (in_array($task['employee_id'], $inactive_emp)) {
                  $custom_style = 'style = "color:red !important;"';
                }
            ?>
                <tr <?php echo $custom_style;  ?>>
                  <td><?php echo $task['emp_name']; ?></td>
                  <td class="text-right"><?php echo sec2hms_new($task['working_hours']); ?></td>
                  <td><?php echo get_bar($task['working_hours'], $task['ewh'], $r_t, $max_wh); ?></td>
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
      "order": [],
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

    $('.startDate').bind('change', function() {
      var endDate = new Date($(this).val());
      var r_t = $('.r_t').val();
      if (r_t == 'daily') {
        endDate.setDate(endDate.getDate());
      }
      if (r_t == 'weekly') {
        endDate.setDate(endDate.getDate() + 6);
      }
      if (r_t == 'monthly') {
        endDate.setMonth(endDate.getMonth() + 1);
      }
      endDate = endDate.getFullYear() + '-' + (endDate.getMonth() + 1) + '-' + endDate.getDate();
      $('.endDate').val(endDate);
    });
  });
</script>