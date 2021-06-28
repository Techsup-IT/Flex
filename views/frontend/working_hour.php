<div id="content-container">
  <div class="pageheader">
    <h3><i class="fa fa-home"></i> <?php echo ucfirst($user_name); ?> <?php echo $lang['working_hours']; ?></h3>
    <div class="breadcrumb-wrapper">
      <span class="label"><?php echo $lang['you_are_here']; ?>:</span>
      <ol class="breadcrumb">
        <li> <a href="<?php echo $link->link('users', frontend); ?>"> <?php echo $lang['users']; ?> </a> </li>
        <li class="active"><?php echo $lang['working_hours']; ?></li>
      </ol>
    </div>
  </div>
  <div id="page-content">
    <br>
    <div class="row">
      <?php echo $display_msg; ?>
      <div class="col-lg-12">
        <form method="POST" class="form-horizontal" action="">
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
            <button class="btn btn-info" name="show_data"><?php echo $lang['show']; ?></button>
          </div>
        </form>

      </div>
    </div>

    <br>
    <div class="panel">
      <div class="panel-heading">
        <h3 class="panel-title"><?php echo $lang['list_all_working_hours']; ?></h3>
      </div>
      <div class="panel-body">
        <table id="demo-dt-basic1" class="table table-striped table-bordered">
          <thead>
            <tr>
              <th> <?php echo $lang['date']; ?> (<?php echo $date_format; ?>)</th>
              <th> <?php echo $lang['check_in']; ?> (HH:MM:SS)</th>
              <th class="min-tablet"> <?php echo $lang['check_out']; ?> (HH:MM:SS)</th>
              <th class="min-tablet"> <?php echo $lang['total_working_time']; ?> (HH:MM:SS)</th>
            </tr>
          </thead>
          <tbody>
            <?php if (is_array($working_details)) {
              foreach ($working_details as $working_hr) { ?>
                <tr>

                  <td>
                    <?php echo $feature->convertTimeZone($working_hr['current_dt']); ?>

                  </td>
                  <td>
                    <?php echo $feature->convertTimeZone(date("Y-m-d H:i:s", $working_hr['check_in']), 'time'); ?>
                  </td>
                  <td class="hidden-xs">
                    <?php
                    if ($working_hr['check_out'] == '') {
                    } else {
                      echo $check_out = $feature->convertTimeZone(date("Y-m-d H:i:s", $working_hr['check_out']), 'time');
                    }   ?>
                  </td>
                  <td class="hidden-xs">

                    <?php
                    $value = $working_hr['check_out_time'];
                    if ($value != '')
                      echo gmdate("H:i:s", $value); ?>
                  </td>
                </tr>
            <?php }
            } ?>
          </tbody>
        </table>
      </div>

    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    var table = $('#demo-dt-basic1').DataTable({
      "oLanguage": {
        'sUrl': '//cdn.datatables.net/plug-ins/1.10.19/i18n/<?php echo $_SESSION['site_lang']; ?>.json'
      }
    });
  });
</script>