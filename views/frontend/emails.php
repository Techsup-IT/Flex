<style type="text/css">
  .email_container {
    border: 1px solid #c5c5c5;
    border-radius: 5px;
    margin-left: 0px;
    margin-right: 0px;
    padding: 5px 0px;
    background: #f6f6f6;
  }
</style>
<div id="content-container">
  <div class="pageheader">
    <h3><i><img src="<?php echo SITE_URL . '/uploads/logo/company_icons/icons_flex-12.png'; ?>" style ="width:40px;height:40px;margin:0 10px;"  alt="Email Picture"></i><?php echo $lang['email']; ?></h3>
    <div class="breadcrumb-wrapper">
      <span class="label"><?php echo $lang['you_are_here']; ?>:</span>
      <ol class="breadcrumb">
        <li class="active"><?php echo $lang['emails']; ?></li>
      </ol>
    </div>
  </div>

  <div id="page-content">
    <div class="panel">
      <?php echo $display_msg; ?>
      <div class="panel-heading">
        <h3 class="panel-title"><?php echo $lang['email']; ?>

          <span class="pull-right">
            <a class="btn btn-primary new_email" href="#" data-toggle="modal" data-target="#newEmailModal"><i class="fa fa-plus"></i> <?php echo $lang['new_email']; ?></a>
          </span>
        </h3>

      </div>
      <div class="panel-body table-responsive">
        <table id="demo-dt-basic1" class="table table-striped table-bordered">
          <thead>
            <tr>
              <th><?php echo $lang['date']; ?></th>
              <th><?php echo $lang['email_from']; ?></th>
              <th><?php echo $lang['email_to']; ?></th>
              <th><?php echo $lang['email_subject']; ?></th>
              <th><?php echo $lang['email_message']; ?></th>
              <th width="15%"> <?php echo $lang['action']; ?></th>
            </tr>
          </thead>
          <tbody>
            <?php if (is_array($emails) && !empty($emails)) {
              $count = 0;
              $msg_check = '';
              if ($_SESSION['department'] == 5 || $_SESSION['department'] == 6 || $_SESSION['department'] == 1 || $_SESSION['department'] == 4) {
                $msg_check = 'admin_status';
              } else {
                $msg_check = 'emp_status';
              }
              foreach ($emails as $email) {
                $unread = '';
                if ($email[$msg_check] == 0) {
                  $unread = 'class="success"';
                }
            ?>
                <tr <?= $unread; ?>>
                  <td><?php echo date('Y-m-d H:i', strtotime($email['created_date'])); ?></td>
                  <td><?php echo $email['email_from']; ?></td>
                  <td><?php echo $email['email_to']; ?></td>
                  <td><?php echo (strlen($email['email_sub']) > 20) ? substr($email['email_sub'], 0, 20) . '...' : $email['email_sub']; ?></td>
                  <td><?php echo (strlen($email['message_data']) > 20) ? substr($email['message_data'], 0, 20) . '...' : $email['message_data']; ?></td>
                  <td>
                    <a href="#" data-toggle="modal" data-target="#viewEmailModal" title="view" data-message-id="<?= $count; ?>" data-email-id="<?= $email['message_id']; ?>" data-msg-check="<?= $msg_check; ?>" class="btn btn-success fa fa-eye view_email"></a>
                    <a href="#" data-toggle="modal" data-target="#newEmailModal" title="reply" data-message-id="<?= $count; ?>" data-email-id="<?= $email['message_id']; ?>" data-msg-check="<?= $msg_check; ?>" class="btn btn-primary fa fa-reply reply_email"></a>
                    <a href="#" data-toggle="modal" data-target="#conversationModal" title="conversation" data-conversation-id="<?= ($email['parent_id'] != 0) ? $email['parent_id'] : $email['message_id']; ?>" class="btn btn-warning fa fa-comments view_conversation"></a>
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

<div class="modal fade" id="newEmailModal" tabindex="-1" role="dialog" aria-labelledby="newEmailModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newEmailModalLabel"><?php echo $lang['new_email']; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="" id="email_form" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group">
            <label for="email_to" class="col-form-label"><?php echo $lang['email_to']; ?>:</label>
            <!-- <input type="email" class="form-control" name="email_to" id="email_to" required> -->
            <select class="form-control" name="email_to" id="email_to" required>
              <?php
              if (!empty($email_list)) {
                foreach ($email_list as $user) {
              ?>
                  <option data-empId="<?= $user['employee_id']; ?>" value="<?= $user['email']; ?>"> <?= $user['emp_name']; ?>&nbsp;<?= $user['emp_surname']; ?>(<?= $user['email']; ?>)</option>
              <?php
                }
              }
              ?>
            </select>
          </div>

          <div class="form-group">
            <label for="email_sub" class="col-form-label"><?php echo $lang['email_subject']; ?>:</label>
            <input type="text" class="form-control" name="email_sub" id="email_sub" required>
          </div>

          <div class="form-group">
            <label for="message_data" class="col-form-label"><?php echo $lang['email_message']; ?>:</label>
            <textarea class="form-control" name="message_data" id="message_data" rows="8" required></textarea>
          </div>

          <div class="form-group">
            <label for="attachments" class="col-form-label"><?php echo $lang['email_attachments']; ?>:</label>
            <input type="file" class="form-control" name="email_attachments[]" id="email_attachments" multiple>
          </div>

        </div>

        <div class="modal-footer">
          <input type="hidden" name="email_from" value="<?= $_SESSION['email']; ?>">
          <input type="hidden" name="receiver_id" id="receiver_id" value="">
          <input type="hidden" name="reply_id" id="reply_id" value="0">
          <input type="hidden" name="parent_id" id="parent_id" value="0">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $lang['close']; ?></button>
          <button type="submit" name="sendMail" value="1" class="btn btn-primary"><?php echo $lang['send']; ?></button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="viewEmailModal" tabindex="-1" role="dialog" aria-labelledby="viewEmailModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewEmailModalLabel"><?php echo $lang['email']; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="view_email_to" class="col-form-label"><?php echo $lang['email_to']; ?>:</label>
          <input type="email" readonly class="form-control" name="view_email_to" id="view_email_to">
        </div>

        <div class="form-group">
          <label for="view_email_sub" class="col-form-label"><?php echo $lang['email_subject']; ?>:</label>
          <input type="text" readonly class="form-control" name="view_email_sub" id="view_email_sub">
        </div>

        <div class="form-group">
          <label for="view_message_data" class="col-form-label"><?php echo $lang['email_message']; ?>:</label>
          <textarea class="form-control" readonly name="view_message_data" id="view_message_data" rows="8"></textarea>
        </div>

        <div class="form-group email_attachments_container">
          <label for="view_email_attachments" class="col-form-label"><?php echo $lang['email_attachments']; ?>:</label>
        </div>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $lang['close']; ?></button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="conversationModal" tabindex="-1" role="dialog" aria-labelledby="conversationModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="conversationModalLabel"><?php echo $lang['email']; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="conversation_container">

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

    $('#email_to').change(function() {
      var empId = $(this).find(':selected').attr('data-empId');
      $('#receiver_id').val(empId);
    });

    $('.view_email').click(function() {
      $(this).parents().parents().removeClass('success');
      $('.email_attachments_container').hide();
      var url = '<?php echo $link->link("emails&markUnread=1", frontend); ?>';
      var email_id = $(this).attr('data-email-id');
      var msg_check = $(this).attr('data-msg-check');
      url += '&email_id=' + email_id + '&msg_check=' + msg_check;
      $.get(url);
      var message_index = $(this).attr('data-message-id');
      var email_data = <?php echo json_encode($emails); ?>;
      var message_data;
      if (email_data[message_index]) {
        message_data = email_data[message_index];
        $('#view_email_to').val(message_data.email_to);
        $('#view_email_sub').val(message_data.email_sub);
        $('#view_message_data').val(message_data.message_data);
        if (message_data.attachments != '') {
          $('.email_attachments_container').show();
          var attachments = JSON.parse(message_data.attachments);
          var html = '';
          $.each(attachments, function(i, v) {
            var file_link = '<?php echo SITE_URL; ?>/uploads/emails/files/' + email_id + '/' + v;
            html += '<a class="form-control btn-info" target="_blank" href="' + file_link + '">' + v + '</a>';
            if (i < (attachments.length - 1)) {
              html += '<br/>';
            }
          });
          $('.email_attachments_container').html(html);
        }
      }
    });

    $('.reply_email').click(function() {
      var email_id = $(this).attr('data-email-id');
      var message_index = $(this).attr('data-message-id');
      var email_data = <?php echo json_encode($emails); ?>;
      var message_data;
      if (email_data[message_index]) {
        message_data = email_data[message_index];
        $('#email_to').val(message_data.email_from);
        $('#email_sub').val(message_data.email_sub);
        if (message_data.parent_id == 0) {
          $('#parent_id').val(email_id);
        } else {
          $('#parent_id').val(message_data.parent_id);
        }
        $('#reply_id').val(email_id);
      }
    });

    $('.new_email').click(function() {
      $('#email_to').val('');
      $('#email_sub').val('');
      $('#parent_id').val(0);
      $('#reply_id').val(0);
    });

    $('#email_form').submit(function() {
      var empId = $(this).find(':selected').attr('data-empId');
      $('#receiver_id').val(empId);
    });

    $('.view_conversation').click(function() {
      var conversation_id = $(this).attr('data-conversation-id');
      var conversation_data = <?php echo json_encode($conversations); ?>;
      if (conversation_data[conversation_id]) {
        var conversation_html = '';
        $.each(conversation_data[conversation_id], function(i, v) {
          conversation_html += `
            <div class="email_container row">
              <div class="col-md-12">
                <div class="pull-right">` + v.created_date + `</div>
              </div>
              <div class="col-md-12">
                <div class="col-md-2"><b><?php echo $lang['email_subject']; ?>: </b></div>
                <div class="col-md-9">` + v.email_sub + `</div>
              </div>
              <div class="col-md-12">
                <div class="col-md-2"><b><?php echo $lang['email_from']; ?>: </b></div>
                <div class="col-md-9">` + v.email_from + `</div>
                <div class="col-md-2"><b><?php echo $lang['email_to']; ?>: </b></div>
                <div class="col-md-9">` + v.email_to + `</div>
              </div>
              <div class="col-md-12">
                <div class="col-md-2"><b><?php echo $lang['email_message']; ?>: </b></div>
                <div class="col-md-9">` + v.message_data + `</div>
              </div>
            </div>
          `;
          if (i < (conversation_data[conversation_id].length - 1)) {
            conversation_html += '<hr/>';
          }
        });
        $('.conversation_container').html(conversation_html);
      }
    });

  });
</script>