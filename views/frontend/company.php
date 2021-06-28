<div id="content-container">
  <div class="pageheader">
    <h3><i><img src="<?php echo SITE_URL . '/uploads/logo/company_icons/icons_flex-02.png'; ?>" style ="width:40px;height:40px;margin:0 10px;"  alt="Company Picture"></i><?php echo $lang['company']; ?></h3>
    <div class="breadcrumb-wrapper">
      <span class="label"><?php echo $lang['you_are_here']; ?>:</span>
      <ol class="breadcrumb">
        <li class="active"><?php echo $lang['company']; ?></li>
      </ol>
    </div>
  </div>

  <div id="page-content">
    <div class="panel">
      <?php echo $display_msg; ?>
      <div class="panel-heading">
        <h3 class="panel-title"><?php echo $lang['list_all_company']; ?>

          <span class="pull-right">
            <a class="btn btn-primary" style="background-color:#8dd3dd;border-color:#8dd3dd;" href="<?php echo $link->link('add_company', frontend); ?>"><i class="fa fa-plus"></i> <?php echo $lang['add_company']; ?></a>
          </span>
        </h3>

      </div>
      <div class="panel-body">
        <table id="demo-dt-basic1" class="table table-striped table-bordered">
          <thead>
            <tr>
              <th><?php echo $lang['company_name']; ?></th>

              <th width="20%"> <?php echo $lang['action']; ?></th>
            </tr>
          </thead>
          <tbody>
            <?php if (is_array($company)) {
              foreach ($company as $company_ls) { ?>
                <tr>
                  <td>
                    <?php echo $company_ls['company_name']; ?>
                  </td>
                  <td>
                    <a href="<?php echo $link->link("edit_company", frontend, '&edit_id=' . $company_ls['id']); ?>" class="btn btn-success fa fa-edit"></a>
                    <?php
                    if ($company_ls['id'] != 1 && $company_ls['id'] != $_SESSION['company_id']) { ?>
                      <a href="<?php echo $link->link("company", frontend, '&del_id=' . $company_ls['id']); ?>" class="btn btn-danger fa fa-trash"></a>
                      <?php
                      if ($company_ls['status'] != 0) { ?>
                        <a href="<?php echo $link->link("company", frontend, '&activate_id=' . $company_ls['id']); ?>" class="btn btn-warning" style="background-color:#203b47;border-color:#203b47;"><?php echo $lang['activate']; ?></a>
                      <?php } else { ?>
                        <a href="<?php echo $link->link("company", frontend, '&deactivate_id=' . $company_ls['id']); ?>" class="btn btn-warning" style="background-color:#0a9bb9;border-color:#0a9bb9;"><?php echo $lang['deactivate']; ?></a>
                      <?php }
                      ?>
                    <?php } ?>
                    <!-- <a href="<?php echo $link->link("company", frontend, '&del_id=' . $company_ls['id']); ?>" class="btn btn-danger fa fa-trash"></a> -->
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
    $('#demo-dt-basic1').DataTable({
      "dom": "<'row'<'col-md-4'l><'col-md-8'Bf>>" + "<'row'<'col-md-6'><'col-md-6'>>" + "<'row'<'col-md-12't>><'row'<'col-md-6'i><'col-md-6'p>>",
      buttons: [{
          extend: 'csv',
          exportOptions: {
            columns: [0]
          }
        },
        {
          extend: 'excel',
          exportOptions: {
            columns: [0]
          }
        },
        {
          extend: 'print',
          exportOptions: {
            columns: [0]
          }
        }
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