<div id="content-container">
  <div class="pageheader">
    <h3><i class="fa fa-user"></i><?php echo $lang['search']; ?></h3>
    <div class="breadcrumb-wrapper">
      <span class="label"><?php echo $lang['you_are_here']; ?>:</span>
      <ol class="breadcrumb">
        <li class="active"><?php echo $lang['search']; ?></li>
      </ol>
    </div>
  </div>

  <div id="page-content">
    <div class="row">
      <div class="col-lg-12">
        <a href="<?php echo $link->link("search", frontend); ?>">
          <button class="btn btn-primary" <?php if (!isset($_REQUEST['type']) || $_REQUEST['type'] == '') { ?>disabled<?php } ?> style="padding: 6px 55px;margin: 0 5px 5px 0;"><?php echo $lang['all_users']; ?></button>
        </a>
        <a href="<?php echo $link->link("search", frontend, '&type=active'); ?>">
          <button class="btn btn-primary" <?php if (isset($_REQUEST['type']) && $_REQUEST['type'] == "active") { ?>disabled<?php } ?> style="padding: 6px 55px;margin: 0 5px 5px 0;"><?php echo $lang['active']; ?></button>
        </a>
        <a href="<?php echo $link->link("search", frontend, '&type=seven_day'); ?>">
          <button class="btn btn-primary" <?php if (isset($_REQUEST['type']) && $_REQUEST['type'] == "seven_day") { ?>disabled<?php } ?> style="padding: 6px 55px;margin: 0 5px 5px 0;"><?php echo $lang['last_7_days']; ?></button>
        </a>
        <a href="<?php echo $link->link("search", frontend, '&type=thirty_day'); ?>">
          <button class="btn btn-primary" <?php if (isset($_REQUEST['type']) && $_REQUEST['type'] == "thirty_day") { ?>disabled<?php } ?> style="padding: 6px 55px;margin: 0 5px 5px 0;"><?php echo $lang['last_30_days']; ?></button>
        </a>
        <a href="<?php echo $link->link("search", frontend, '&type=sixty_day'); ?>">
          <button class="btn btn-primary" <?php if (isset($_REQUEST['type']) && $_REQUEST['type'] == "sixty_day") { ?>disabled<?php } ?> style="padding: 6px 55px;margin: 0 5px 5px 0;"><?php echo $lang['last_60_days']; ?></button>
        </a>
        <a href="<?php echo $link->link("search", frontend, '&type=inactive'); ?>">
          <button class="btn btn-primary" <?php if (isset($_REQUEST['type']) && $_REQUEST['type'] == "inactive") { ?>disabled<?php } ?> style="padding: 6px 55px;margin: 0 5px 5px 0;"><?php echo $lang['inactive']; ?></button>
        </a>
      </div>
    </div>
    <br />
    <div class="panel">
      <?php echo $display_msg; ?>
      <div class="panel-body">
        <table id="example1" class="cell-border example1 table table-striped table1 delSelTable">
          <thead>
            <tr>
              <th><?php echo $lang['id']; ?></th>
              <th><?php echo $lang['name']; ?></th>
              <th><?php echo $lang['email']; ?></th>
              <th><?php echo $lang['company']; ?></th>
              <th><?php echo $lang['role']; ?></th>
            </tr>
          </thead>
          <tbody>

          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
  $(document).ready(function() {
    var url = '<?php echo $link->link("get_search_data", frontend); ?>';
    var type = '<?php echo isset($_REQUEST["type"]) ? $_REQUEST["type"] : ""; ?>';
    if (type != '') {
      url = url + '&type=' + type;
    }
    var table = $('#example1').DataTable({
      // dom: 'lfBrtip',
      "dom": "<'row'<'col-md-4'l><'col-md-8'Bf>>" + "<'row'<'col-md-6'><'col-md-6'>>" + "<'row'<'col-md-12't>><'row'<'col-md-6'i><'col-md-6'p>>",
      buttons: [
        'csv', 'excel', 'print'
      ],
      // "responsive": true,
      "language": {
        "paginate": {
          "previous": '<i class="fa fa-angle-left"></i>',
          "next": '<i class="fa fa-angle-right"></i>'
        }
      },
      "processing": true,
      "serverSide": true,
      "ajax": url,
      "iDisplayLength": 10,
      "oLanguage": {
        'sUrl': '//cdn.datatables.net/plug-ins/1.10.19/i18n/<?php echo $_SESSION['site_lang']; ?>.json'
      }
    });
  });
</script>