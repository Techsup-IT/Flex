<div id="content-container">
  <div class="pageheader">
    <h3><i><img src="<?php echo SITE_URL . '/uploads/logo/company_icons/icons_flex-03.png'; ?>" style ="width:40px;height:40px;margin:0 10px;"  alt="Supervisors Picture"></i><?php echo $lang['supervisors']; ?></h3>
    <div class="breadcrumb-wrapper">
      <span class="label"><?php echo $lang['you_are_here']; ?>:</span>
      <ol class="breadcrumb">
        <li class="active"><?php echo $lang['supervisors']; ?></li>
      </ol>
    </div>
  </div>



  <div id="page-content">
    <div class="panel-heading">
      <span class="pull-right">
        <?php
        if ($_SESSION['department'] == 5) {
        ?>
          <a class="btn btn-primary" href="<?php echo $link->link('add_supervisor', frontend); ?>"><i class="fa fa-plus"></i> <?php echo $lang['add_supervisor']; ?></a>
        <?php
        }
        ?>
      </span>
    </div>


    <?php echo $display_msg; ?>

    <div class="row">
      <table id="example1" class="cell-border example1 table table-striped table1 delSelTable">
        <thead>
          <tr>
            <th><?php echo $lang['id']; ?></th>
            <th><?php echo $lang['name']; ?></th>
            <th><?php echo $lang['email']; ?></th>
            <th width="20%"><?php echo $lang['action']; ?></th>
          </tr>
        </thead>
        <tbody>
          <?php
          if (isset($users) && !empty($users)) {
            foreach ($users as $user) {
          ?>
              <tr>
                <td><?php echo $user['employee_id']; ?></td>
                <td><?php echo $user['emp_name'] . ' ' . $user['emp_surname']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td>
                  <!--<a href="<?php echo $link->link("edit_supervisor", frontend, '&edit=' . $user['employee_id']); ?>"><span class="label label-success"><?php echo $lang["update"]; ?></span></a>-->
                   <a href="<?php echo $link->link("edit_supervisor", frontend, '&edit=' . $user['employee_id']); ?>"><span class="btn btn-success fa fa-edit"></span></a>
                  <!--<a href="<?php echo $link->link("supervisors", frontend, '&del_id=' . $user['employee_id']); ?>"><span class="label label-danger"><?php echo $lang["delete"]; ?></span></a>-->
                   <a href="<?php echo $link->link("supervisors", frontend, '&del_id=' . $user['employee_id']); ?>"><span class="btn btn-danger fa fa-trash"></span></a>
                  <?php
                  if ($user['status'] == 1) {
                  ?>
                    <a href="<?php echo $link->link("supervisors", frontend, '&activate_id=' . $user['employee_id']); ?>"><span class="label label-warning btn-warning-activate" style="background-color:#203b47;border-color:#203b47;"><?php echo $lang['activate']; ?></span></a>
                  <?php
                  } else {
                  ?>
                    <a href="<?php echo $link->link("supervisors", frontend, '&deactivate_id=' . $user['employee_id']); ?>"><span class="label label-warning btn-warning-activate" style="background-color:#0a9bb9;border-color:#0a9bb9;"><?php echo $lang['deactivate']; ?></span></a>
                  <?php
                  }
                  ?>
                </td>
              </tr>
          <?php
            }
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>


<script type="text/javascript">
  $(document).ready(function() {
    var table = $('#example1').DataTable({
      // dom: 'lfBrtip',
      "dom": "<'row'<'col-md-4'l><'col-md-8'Bf>>" + "<'row'<'col-md-6'><'col-md-6'>>" + "<'row'<'col-md-12't>><'row'<'col-md-6'i><'col-md-6'p>>",
      buttons: [{
          extend: 'csv',
          exportOptions: {
            columns: [0, 1, 2]
          }
        },
        {
          extend: 'excel',
          exportOptions: {
            columns: [0, 1, 2]
          }
        },
        {
          extend: 'print',
          exportOptions: {
            columns: [0, 1, 2]
          }
        }
      ],
      // "responsive": true,
      "language": {
        "paginate": {
          "previous": '<i class="fa fa-angle-left"></i>',
          "next": '<i class="fa fa-angle-right"></i>'
        }
      },
      "iDisplayLength": 10,
      "oLanguage": {
        'sUrl': '//cdn.datatables.net/plug-ins/1.10.19/i18n/<?php echo $_SESSION['site_lang']; ?>.json'
      }
    });
  });
</script>