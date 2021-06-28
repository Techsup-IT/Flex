<div id="content-container">
  <div class="pageheader">
    <h3><i><img src="<?php echo SITE_URL . '/uploads/logo/company_icons/icons_flex-08.png'; ?>" style ="width:40px;height:40px;margin:0 10px;"  alt="Projects Picture"></i><?php echo $lang['projects']; ?></h3>
    <div class="breadcrumb-wrapper">
      <span class="label"><?php echo $lang['you_are_here']; ?>:</span>
      <ol class="breadcrumb">
        <li class="active"><?php echo $lang['projects']; ?></li>
      </ol>
    </div>
  </div>



  <div id="page-content">
    <div class="panel">
      <?php echo $display_msg; ?>
      <div class="panel-heading">
        <h3 class="panel-title"><?php echo $lang['list_of_all_projects']; ?>

          <span class="pull-right">
            <a class="btn btn-primary" href="<?php echo $link->link('add_project', frontend); ?>"><i class="fa fa-plus"></i> <?php echo $lang['add_project']; ?></a>
            <!--   <button class="btn btn-default" type="button"><i class="fa fa-edit"></i> Edit </button>
                                 <button class="btn btn-default" type="button"><i class="fa fa-trash"></i> Trash</button> -->
          </span>
        </h3>

      </div>
      <div class="panel-body">
        <table id="demo-dt-basic1" class="table table-striped table-bordered">
          <thead>
            <tr>
              <th class="min-tablet" width="10%"><?php echo $lang['start_date']; ?> <br />(<?php echo $date_format; ?>)</th>
              <th class="min-tablet" width="10%"><?php echo $lang['end_date']; ?> <br />(<?php echo $date_format; ?>)</th>
              <th class="min-tablet" width="5%"> <?php echo $lang['company_id']; ?></th>
              <th class="min-tablet" width="20%"> <?php echo $lang['project_title']; ?></th>
              <th class="min-tablet" width="10%"> <?php echo $lang['total_assign']; ?></th>

              <th class="min-tablet" width="8%"> <?php echo $lang['created_by']; ?></th>

              <th width="8%"> <?php echo $lang['action']; ?></th>
            </tr>
          </thead>
          <tbody>
            <?php if (is_array($projects_details)) {
              foreach ($projects_details as $projects_ls) { ?>
                <tr>
                  <td>
                    <?php echo $feature->convertTimeZone($projects_ls['start_date']); ?>
                  </td>
                  <td>
                    <?php echo $feature->convertTimeZone($projects_ls['end_date']); ?>
                  </td>
                  <td>
                    <?php echo $projects_ls['company_id']; ?>
                  </td>
                  <td>
                    <?php echo $projects_ls['project_name']; ?>
                  </td>
                  <td>
                    <?php
                    /* this is for keyborad action,mouse action, mouse movement*/
                    $project_as = $projects_ls['project_assign_count'];
                    $project_type = $projects_ls['project_type'];
                    if ($project_type == "private" || $project_type == "none") {
                      if ($project_as <= 0) {
                        echo "NA (" . $project_as . ")";
                      } else {
                        echo $lang['private'] . " (" . $project_as . ")";
                      }
                    } else {
                      echo $lang['public'];
                    }
                    ?>
                  </td>
                  <td>
                    <?php $current_employee_id = $projects_ls['employee_id'];


                    $employee_dname = $db->get_var('employee', array('employee_id' => $current_employee_id), 'department');
                    if ($employee_dname == 1) {
                      echo $lang['own'];
                    } else {
                      echo $employee_name = $db->get_var('employee', array('employee_id' => $current_employee_id), 'emp_name');
                    }

                    ?>

                  </td>
                  <td>
                    <a href="<?php echo $link->link("edit_project", frontend, '&edit_project_id=' . $projects_ls['project_id']); ?>" class="btn btn-success fa fa-edit"></a>
                    <a href="<?php echo $link->link("projects", frontend, '&del_project_id=' . $projects_ls['project_id']); ?>" class="btn btn-danger fa fa-trash"></a>
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
    /*var table = $('#demo-dt-basic1').DataTable();
    var department = "<?php echo $_SESSION['department']; ?>"; 
    if(department == 5){
      $('#demo-dt-basic1_filter').append('<div id="extra_filter"><select id="company" class="form-control input-sm"><option value="">All Company</option><?php if (isset($company)) {
                                                                                                                                                            foreach ($company as $res) { ?><option value="<?php echo $res['id']; ?>"><?php echo $res['company_name']; ?></option><?php }
                                                                                                                                                                                                                                                                              } ?></select></div><div style="clear:both;"></div>');
      $('#company').on('change',function(){
          table.columns(2).search(this.value).draw();
      });
    }*/
    $('#demo-dt-basic1').DataTable({
      "dom": "<'row'<'col-md-4'l><'col-md-8'Bf>>" + "<'row'<'col-md-6'><'col-md-6'>>" + "<'row'<'col-md-12't>><'row'<'col-md-6'i><'col-md-6'p>>",
      buttons: [{
          extend: 'csv',
          exportOptions: {
            columns: [0, 1, 2, 3, 4, 5]
          }
        },
        {
          extend: 'excel',
          exportOptions: {
            columns: [0, 1, 2, 3, 4, 5]
          }
        },
        {
          extend: 'print',
          exportOptions: {
            columns: [0, 1, 2, 3, 4, 5]
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
      "oLanguage": {
        'sUrl': '//cdn.datatables.net/plug-ins/1.10.19/i18n/<?php echo $_SESSION['site_lang']; ?>.json'
      }
    });
  });
</script>