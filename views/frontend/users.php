<div id="content-container">
  <div class="pageheader">
    <h3><i class="fa fa-user"></i><?php echo $lang['users']; ?></h3>
    <div class="breadcrumb-wrapper">
      <span class="label"><?php echo $lang['you_are_here']; ?>:</span>
      <ol class="breadcrumb">
        <li class="active"><?php echo $lang['users']; ?></li>
      </ol>
    </div>
  </div>



  <div id="page-content">
    <div class="panel-heading">
      <span class="pull-right">

        <a class="btn btn-primary" href="<?php echo $link->link('add_user', frontend); ?>"><i class="fa fa-plus"></i> <?php echo $lang['add_user']; ?></a>

        <!--   <button class="btn btn-default" type="button"><i class="fa fa-edit"></i> Edit </button>
                                 <button class="btn btn-default" type="button"><i class="fa fa-trash"></i> Trash</button> -->
      </span>
    </div>


    <?php echo $display_msg;
    if (isset($_REQUEST['max_users']) && $_REQUEST['max_users'] == 1) {
      echo '<div class="alert alert-danger">
                              <i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["max_emp_exceed"] . '
                              </div>';
    }
    ?>

    <div class="row">
      <table id="example1" class="cell-border example1 table table-striped table1 delSelTable">
        <thead>
          <tr>
            <th><?php echo $lang['id']; ?></th>
            <th><?php echo $lang['name']; ?></th>
            <th><?php echo $lang['email']; ?></th>
            <th><?php echo $lang['type']; ?></th>
            <th><?php echo $lang['status']; ?></th>
            <th><?php echo $lang['clock_in_out']; ?></th>
            <th><?php echo $lang['action']; ?></th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
  </div>
</div>


<script type="text/javascript">
  $(document).ready(function() {
    var department = "<?php echo $_SESSION['department']; ?>";
    var url = '<?php echo $link->link("get_users", frontend); ?>';
    var table = $('#example1').DataTable({
      dom: 'lfBrtip',
      "processing": true,
      "serverSide": true,
      "ajax": url,
      "iDisplayLength": 10,
      "oLanguage": {
        'sUrl': '//cdn.datatables.net/plug-ins/1.10.19/i18n/<?php echo $_SESSION['site_lang']; ?>.json'
      }
    });
    /*if(department == 5){
      $('#example1_filter').append('<div id="extra_filter"><select id="company" class="form-control input-sm"><option value="">All Company</option><?php if (isset($company)) {
                                                                                                                                                      foreach ($company as $res) { ?><option value="<?php echo $res['id']; ?>"><?php echo $res['company_name']; ?></option><?php }
                                                                                                                                                                                                                                                                        } ?></select></div><div style="clear:both;"></div>');
      $('#company').on('change',function(){
          table.columns(1).search(this.value).draw();
      });
    }*/
  });
</script>