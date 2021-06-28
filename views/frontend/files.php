<div id="content-container">
  <div class="pageheader">
    <h3><i><img src="<?php echo SITE_URL . '/uploads/logo/company_icons/icons_flex-13.png'; ?>" style ="width:40px;height:40px;margin:0 10px;"  alt="File Picture"></i><?php echo $lang['file']; ?></h3>
    <div class="breadcrumb-wrapper">
      <span class="label"><?php echo $lang['you_are_here']; ?>:</span>
      <ol class="breadcrumb">
        <li class="active"><?php echo $lang['files']; ?></li>
      </ol>
    </div>
  </div>

  <div id="page-content">
    <div class="panel">
      <?php echo $display_msg; ?>
      <div class="panel-heading">
        <h3 class="panel-title"><?php echo $lang['file']; ?>

          <span class="pull-right">
            <a class="btn btn-primary new_file" href="#" data-toggle="modal" data-target="#newFileModal"><i class="fa fa-plus"></i> <?php echo $lang['new_file']; ?></a>
          </span>
        </h3>

      </div>
      <div class="panel-body table-responsive">
        <table id="demo-dt-basic1" class="table table-striped table-bordered">
          <thead>
            <tr>
              <th><?php echo $lang['date']; ?></th>
              <th><?php echo $lang['file_from']; ?></th>
              <th><?php echo $lang['file_to']; ?></th>
              <th><?php echo $lang['file_desc']; ?></th>
              <th><?php echo $lang['file_name']; ?></th>
              <th width="15%"> <?php echo $lang['action']; ?></th>
            </tr>
          </thead>
          <tbody>
            <?php if (is_array($files) && !empty($files)) {
              $count = 0;
              $msg_check = '';
              if ($_SESSION['department'] == 5 || $_SESSION['department'] == 6 || $_SESSION['department'] == 1 || $_SESSION['department'] == 4) {
                $msg_check = 'admin_status';
              } else {
                $msg_check = 'emp_status';
              }
              foreach ($files as $file) {
                $unread = '';
                if ($file[$msg_check] == 0) {
                  $unread = 'class="success"';
                }
            ?>
                <tr <?= $unread; ?>>
                  <td><?php echo date('Y-m-d H:i', strtotime($file['created_date'])); ?></td>
                  <td><?php echo $file['file_from']; ?></td>
                  <td><?php echo $file['file_to']; ?></td>
                  <td><?php echo (strlen($file['file_desc']) > 20) ? substr($file['file_desc'], 0, 20) . '...' : $file['file_desc']; ?></td>
                  <td><?php echo (strlen($file['file_name']) > 20) ? substr($file['file_name'], 0, 20) . '...' : $file['file_name']; ?></td>
                  <td>
                    <a href="#" data-toggle="modal" data-target="#viewFileModal" title="view" data-message-id="<?= $count; ?>" data-file-id="<?= $file['message_id']; ?>" data-msg-check="<?= $msg_check; ?>" class="btn btn-success fa fa-eye view_file"></a>
                    <a href="#" data-toggle="modal" data-target="#newFileModal" title="reply" data-message-id="<?= $count; ?>" data-file-id="<?= $file['message_id']; ?>" data-msg-check="<?= $msg_check; ?>" class="btn btn-primary fa fa-reply reply_file"></a>
                    <!-- <span class="badge badge-primary">#</span> -->
                  </td>
                </tr>
            <?php
                $count++;
              }
            } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="newFileModal" tabindex="-1" role="dialog" aria-labelledby="newFileModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newFileModalLabel"><?php echo $lang['new_file']; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="" id="file_form" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group">
            <label for="file_to" class="col-form-label"><?php echo $lang['file_to']; ?>:</label>
            <!-- <input type="email" class="form-control" name="email_to" id="email_to" required> -->
            <select class="form-control" name="file_to" id="file_to" required>
              <?php
              if (!empty($file_list)) {
                foreach ($file_list as $user) {
              ?>
                  <option data-empId="<?= $user['employee_id']; ?>" value="<?= $user['email']; ?>"> <?= $user['emp_name']; ?>&nbsp;<?= $user['emp_surname']; ?>(<?= $user['email']; ?>)</option>
              <?php
                }
              }
              ?>
            </select>
          </div>

          <div class="form-group">
            <label for="file_desc" class="col-form-label"><?php echo $lang['file_desc']; ?>:</label>
            <input type="text" class="form-control" name="file_desc" id="file_desc" required>
          </div>

          <div class="form-group">
            <label for="file" class="col-form-label"><?php echo $lang['file']; ?>:</label>
            <input type="file" class="form-control" id="file" name="file" required>
          </div>
        </div>

        <div class="modal-footer">
          <input type="hidden" name="file_from" value="<?= $_SESSION['email']; ?>">
          <input type="hidden" name="receiver_id" id="receiver_id" value="">
          <input type="hidden" name="reply_id" id="reply_id" value="0">
          <input type="hidden" name="parent_id" id="parent_id" value="0">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $lang['close']; ?></button>
          <button type="submit" name="sendFile" value="1" class="btn btn-primary"><?php echo $lang['send']; ?></button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="viewFileModal" tabindex="-1" role="dialog" aria-labelledby="viewFileModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewFileModalLabel"><?php echo $lang['file']; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="view_file_to" class="col-form-label"><?php echo $lang['file_to']; ?>:</label>
          <input type="text" readonly class="form-control" name="view_file_to" id="view_file_to">
        </div>

        <div class="form-group">
          <label for="view_file_desc" class="col-form-label"><?php echo $lang['file_desc']; ?>:</label>
          <input type="text" readonly class="form-control" name="view_file_desc" id="view_file_desc">
        </div>

        <div class="form-group">
          <label for="view_file" class="col-form-label"><?php echo $lang['file']; ?>:</label>
          <a class="form-control btn-info" target="_blank" id="view_file" href=""></a>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $lang['close']; ?></button>
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
      "language": {
        "paginate": {
          "previous": '<i class="fa fa-angle-left"></i>',
          "next": '<i class="fa fa-angle-right"></i>'
        }
      },
      "order": [
        [0, "desc"]
      ],
      "oLanguage": {
        'sUrl': '//cdn.datatables.net/plug-ins/1.10.19/i18n/<?php echo $_SESSION['site_lang']; ?>.json'
      }
    });

    $('#file_to').change(function() {
      var empId = $(this).find(':selected').attr('data-empId');
      $('#receiver_id').val(empId);
    });

    $('.view_file').click(function() {
      $(this).parents().parents().removeClass('success');
      var url = '<?php echo $link->link("files&markUnread=1", frontend); ?>';
      var file_id = $(this).attr('data-file-id');
      var msg_check = $(this).attr('data-msg-check');
      url += '&file_id=' + file_id + '&msg_check=' + msg_check;
      $.get(url);
      var file_index = $(this).attr('data-message-id');
      var file_data = <?php echo json_encode($files); ?>;
      var file_details;
      if (file_data[file_index]) {
        file_details = file_data[file_index];
        $('#view_file_to').val(file_details.file_to);
        $('#view_file_desc').val(file_details.file_desc);
        $('#view_file').attr('href', '<?php echo SITE_URL; ?>/uploads/files/' + file_details.file_name);
        $('#view_file').text(file_details.file_name);
      }
    });

    $('.reply_file').click(function() {
      var file_id = $(this).attr('data-file-id');
      var file_index = $(this).attr('data-message-id');
      var file_data = <?php echo json_encode($files); ?>;
      var file_details;
      if (file_data[file_index]) {
        file_details = file_data[file_index];
        $('#file_to').val(file_details.file_to);
        $('#file_desc').val(file_details.file_desc);
        if (file_details.parent_id == 0) {
          $('#parent_id').val(file_id);
        } else {
          $('#parent_id').val(file_details.parent_id);
        }
        $('#reply_id').val(file_id);
      }
    });

    $('.new_file').click(function() {
      $('#file_to').val('');
      $('#file_desc').val('');
      $('#parent_id').val(0);
      $('#reply_id').val(0);
    });

    $('#file_form').submit(function() {
      var empId = $(this).find(':selected').attr('data-empId');
      $('#receiver_id').val(empId);
    });

  });
</script>