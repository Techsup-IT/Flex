<!-- <link href="<?php echo SITE_URL; ?>/assets/frontend/js/report_buttons/buttons.dataTables.min.css" rel="stylesheet" type="text/css" /> -->
<div id="content-container">
  <div class="pageheader">
    <h3><i><img src="uploads/logo/company_icons/icons_flex-21.png" style ="width:50px;height:50px;"></i> <?php echo ucfirst($company_details['company_name']);?> - <?php echo $lang[$r_t];?> <?php echo $lang['empolyee'].' '.$lang['report']; ?></h3>
    <div class="breadcrumb-wrapper">
      <span class="label"><?php echo $lang['you_are_here']; ?>:</span>
        <ol class="breadcrumb">
          <li class="active"><?php echo $lang['empolyee'].' '.$lang['report']; ?></li>
        </ol>
    </div>
  </div>

  <div id="page-content">
    <div class="row">
      <?php echo $display_msg;?>
      
      <div class="col-lg-12">
          <a href="<?php echo $link->link("employee_reports",frontend,'&twc'); if(isset($all_companies_users) && $all_companies_users == 1){echo '&all_companies_user'; } ?>" >
            <button class="btn btn-primary" <?php if(isset($is_rt) && $is_rt =="twc"){?>disabled<?php }?> ><?php echo $lang['twc']; ?></button>
          </a>

          <a href="<?php echo $link->link("employee_reports",frontend,'&active'); if(isset($all_companies_users) && $all_companies_users == 1){echo '&all_companies_user'; }?>">
            <button class="btn btn-primary" <?php if(isset($is_rt) && $is_rt =="active"){?>disabled<?php }?> ><?php echo $lang['active']; ?></button>
          </a>
          
          <a href="<?php echo $link->link("employee_reports",frontend,'&inactive'); if(isset($all_companies_users) && $all_companies_users == 1){echo '&all_companies_user'; }?>">
            <button class="btn btn-primary" <?php if(isset($is_rt) && $is_rt =="inactive"){?>disabled<?php }?> ><?php echo $lang['inactive']; ?></button>
          </a>

          <?php 
            if($_SESSION['department'] == 5){
              ?>
              <label class="checkbox-inline">&nbsp;&nbsp;<input type="checkbox" <?php if($all_companies_users == 1) echo 'checked'; ?> class="admin_check" name="admin_check" value="1"><?php echo $lang['all_company']; ?></label>
              <?php
            }
          ?>
      </div>

    </div>
    <br>

    <div class="panel">
      <div class="panel-body table-responsive">
        <table id="company_report" class="table table-striped table-bordered">
          <thead>
            <tr>
              <th><?php echo $lang['id'] ?></th>
              <th class="hidden"><?php echo $lang['is_mol_TWC'] ?></th>
              <th><?php echo $lang['employee_name'] ?></th>
              <?php
              if(isset($all_companies_users) && $all_companies_users == 1){
                ?>
                <th><?php echo $lang['company_name'] ?></th>
                <?php
              }
              ?>
              <th><?php echo $lang['IdNumber'] ?></th>
              <th><?php echo $lang['EstLaborOfficeId'] ?></th>
              <th><?php echo $lang['EstSequenceNumber'] ?></th>
              <th><?php echo $lang['email'] ?></th>
              <th><?php echo $lang['phone_number'] ?></th>
              <th><?php echo $lang['address'] ?></th>
              <?php
                if($is_rt =="active" || $is_rt =="inactive"){
                  ?>
                  <th><?php echo $lang['clock_in_out']; ?></th>
                  <?php
                }
              ?>
              <!-- <th class="hidden"><?php echo $lang['is_mol_TWC'] ?></th> -->
            </tr>
          </thead>
          <tbody>
            <?php if(isset($employees) && count($employees) > 0){
              foreach ($employees as $employee) {
                ?>
                <tr>
                  <td><?php echo $employee['employee_id']; ?></td>
                  <td  class="hidden"><?php echo $employee['is_molTWC']; ?></td>
                  <td><?php echo ucwords(trim($employee['emp_name'].' '.$employee['emp_surname'])); ?></td>
                  <?php
                  if(isset($all_companies_users) && $all_companies_users == 1){
                    ?>
                    <td><?php echo $employee['company_name']; ?></td>
                    <?php
                  }
                  ?>
                  <td><?php echo $employee['IdNumber']; ?></td>
                  <td><?php echo $employee['EstLaborOfficeId']; ?></td>
                  <td><?php echo $employee['EstSequenceNumber']; ?></td>
                  <td><?php echo $employee['email']; ?></td>
                  <td><?php echo $employee['contact1']; ?></td>
                  <td><?php echo $employee['address']; ?></td>
                  <?php
                    if($is_rt =="active" || $is_rt =="inactive"){
                      ?>
                      <td><span class="label label-warning"><?php echo $employee['check_count']; ?></span></td>
                      <?php
                    }
                  ?>
                  <!-- <td  class="hidden"><?php echo $employee['is_molTWC']; ?></td> -->
                </tr>
                <?php
              }
            }?>
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
$(document).ready(function(){
  var showExtraFilter = 0;
  var is_rt = '<?php echo $is_rt; ?>';
  if(is_rt == 'active' || is_rt == 'inactive'){
    showExtraFilter = 1;
  }

  var table = $('#company_report').DataTable({
      // "dom": "<'row'<'col-md-4'l><'col-md-8'Bf>>" +"<'row'<'col-md-6'><'col-md-6'>>" +"<'row'<'col-md-12't>><'row'<'col-md-6'i><'col-md-6'p>>",
      "dom": "<'row'<'col-md-2'l><'col-md-8'Bf><'col-md-2 extra_filter'>>" +"<'row'<'col-md-6'><'col-md-6'>>" +"<'row'<'col-md-12't>><'row'<'col-md-6'i><'col-md-6'p>>",
      initComplete: function(){
        if(showExtraFilter == 1){
          $("div.extra_filter").html(
            `<div class="twc_filter">
              <label class="control-label"><?php echo $lang["twc"]; ?> </label>
              <select id="twc_type" class="form-control input-sm">
                <option value=""></option>
                <option value="1"><?php echo $lang['yes']; ?></option>
                <option value="0"><?php echo $lang['no']; ?></option>
              </select>
            </div>`
          );
        }
      },
      // buttons: [
      //     'csv', 'excel', 'print'
      // ],
      buttons: [
      {
        extend: 'csv',
        exportOptions: {columns: ':visible'}
      },
      {
        extend: 'excel',
        exportOptions: {columns: ':visible'}
      },
      {
        extend: 'print',
        exportOptions: {columns: ':visible'}
      }
      ],
      "responsive": true,
      "order": [],
      "language": {
          "paginate": {
              "previous": '<i class="fa fa-angle-left"></i>',
              "next": '<i class="fa fa-angle-right"></i>'
          }
      },
      "oLanguage" : { 'sUrl' : '//cdn.datatables.net/plug-ins/1.10.19/i18n/<?php echo $_SESSION['site_lang']; ?>.json'}
  });

  table.columns([1]).every(function (){
    var that = this;
    $(document).on('change', '#twc_type', function(){
      if ( that.search() !== this.value ){
        that.search( this.value ).draw();
      }
    });
  });

  $('.admin_check').change(function(){
    var url = window.location.href;
    if($(this).prop('checked') == true){
      window.location.href = url+'&all_companies_user';
    }
    else{
      url = url.replace('&all_companies_user', '');
      window.location.href = url;
    }
  });

});
</script>