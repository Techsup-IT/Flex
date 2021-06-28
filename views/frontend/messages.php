<style type="text/css">
  .messages_container {
    width: 90%;
    margin: 0 auto;
    padding: 10px;
    /*height: 300px;*/
    height: calc(100vh - 40vh);
    overflow: auto;
  }

  .s_msg_container {
    color: #000;
    background: #FFF;
    padding: 8px;
    margin: 2px;
    width: auto;
    border: 1px solid #989898;
    border-radius: 10px;
    display: table;
  }

  .my_msg {
    background: #4aae20;
    float: right;
  }

  .msg_time {
    font-size: 9px;
    color: #c5c5c5;
    top: 3px;
    position: relative;
    margin: 0 5px 0 10px;
  }

  .chat_form_container {
    width: 90%;
    margin: 10px auto;
    padding: 5px;
  }

  .chat_user {
    font-size: 15px;
    font-weight: bold;
    border: 1px solid #c5c5c5;
    padding: 10px;
    background: #a7c4d3;
    border-radius: 10px;
  }

  .chat_user i {
    color: #FFF;
  }
</style>

<div id="content-container">
  <div class="pageheader">
    <h3><i><img src="<?php echo SITE_URL . '/uploads/logo/company_icons/icons_flex-11.png'; ?>" style ="width:40px;height:40px;margin:0 10px;"  alt="Messages Picture"></i><?php echo $lang['messages']; ?></h3>
    <div class="breadcrumb-wrapper">
      <span class="label"><?php echo $lang['you_are_here']; ?>:</span>
      <ol class="breadcrumb">
        <li class="active"></li><?php echo $lang['messages']; ?></li>
      </ol>
    </div>
  </div>

  <div id="page-content">
    <!-- <div class="panel-heading">
      <span class="pull-right">
        <a class="btn btn-primary" href="<?php echo $link->link('add_user', frontend); ?>"><i class="fa fa-plus"></i> Add User</a>
      </span>
    </div> -->
    <?php echo $display_msg; ?>
    <?php
    // echo "<pre>"; print_r($_SESSION); exit();
    if (($_SESSION['department'] == 5 || $_SESSION['department'] == 1 || $_SESSION['department'] == 4 || $_SESSION['department'] == 6) && (!isset($_REQUEST['employee_id']) || $_REQUEST['employee_id'] = '')) {
    ?>
      <div class="row">
        <table id="demo-dt-basic1" class="table table-striped table-bordered">
          <thead>
            <tr>
              <th><?php echo $lang['id']; ?></th>
              <th><?php echo $lang['name']; ?></th>
              <th><?php echo $lang['email']; ?></th>
              <th><?php echo $lang['action']; ?></th>
            </tr>
          </thead>
          <tbody>
            <?php
            if (isset($users) && count($users) > 0) {
              foreach ($users as $user) {
            ?>
                <tr>
                  <td><?php echo $user['employee_id']; ?></td>
                  <td><?php echo ucwords($user['emp_name'] . ' ' . $user['emp_surname']); ?></td>
                  <td><?php echo $user['email']; ?></td>
                  <td>
                    <a href="<?php echo $link->link("messages", frontend, '&employee_id=' . $user['employee_id']); ?>" class="btn btn-success"><?php echo $lang['messages']; ?></a>
                    <?php
                    $message_notification = 0;
                    $user_messages = array();
                    $user_messages = $db->run("SELECT * from `messages` where `employee_id`= '" . $user['employee_id'] . "' AND `company_id` = '" . $_SESSION['company_id'] . "' and admin_status = 0 ")->fetchAll();
                    $message_notification = count($user_messages);
                    if ($message_notification > 0) {
                    ?>
                      &nbsp;<span class="notification badge badge-info"><?php echo $message_notification; ?></span>
                    <?php
                    }
                    ?>
                    <!-- <a href="<?php echo $link->link("messages", frontend, '&del_id=' . $user['employee_id']); ?>" class="btn btn-danger fa fa-trash"></a> -->
                  </td>
                </tr>
            <?php
              }
            }
            ?>
          </tbody>
        </table>
      </div>
      <?php
    } else {
      if ($_SESSION['department'] == 5 || $_SESSION['department'] == 1 || $_SESSION['department'] == 4 || $_SESSION['department'] == 6) {
      ?>
        <div class="panel-heading">
          <span class="pull-left">
            <span class="chat_user">
              <i class="fa fa-user"></i>&nbsp;
              <?php
              if (isset($_GET['employee_id']) && $_GET['employee_id'] != '') {
                $emp_details = $db->run("SELECT emp_name, emp_surname from `employee` where `employee_id`= '" . $_GET['employee_id'] . "' AND `company_id` = '" . $_SESSION['company_id'] . "' ")->fetchAll();
                if ($emp_details && count($emp_details) > 0) {
                  echo ucwords($emp_details[0]['emp_name'] . ' ' . $emp_details[0]['emp_surname']);
                }
              }
              ?>
            </span>
          </span>
          <span class="pull-right">
            <a class="btn btn-primary" href="<?php echo $link->link('messages', frontend); ?>"><i class="fa fa-user"></i> <?php echo $lang['users']; ?></a>
          </span>
        </div>
      <?php
      }
      ?>
      <div class="row">
        <div class="messages_container">
          <?php
          if (isset($messages) && count($messages) > 0) {
            foreach ($messages as $msg) {
              $is_my_msg = '';
              $user_status = '';
              if ($_SESSION['department'] == 5 || $_SESSION['department'] == 1 || $_SESSION['department'] == 4 || $_SESSION['department'] == 6) {
                $user_status = 'admin_status';
              }
              if ($_SESSION['department'] == 2 || $_SESSION['department'] == 3) {
                $user_status = 'emp_status';
              }

              if ($_SESSION['department'] == 2 || $_SESSION['department'] == 3 && $msg['manager_id'] == 0) {
                $is_my_msg = 'my_msg';
              }
              if (($_SESSION['department'] == 5 || $_SESSION['department'] == 1 || $_SESSION['department'] == 4 || $_SESSION['department'] == 6) && $msg['manager_id'] != 0) {
                $is_my_msg = 'my_msg';
              }
              $update = $db->update('messages', array($user_status => 1), array('message_id' => $msg['message_id']));
          ?>
              <div class="s_msg_container <?php echo $is_my_msg; ?>">
                <div class="msg_data"><?php echo $msg['message_data']; ?>
                  <span class="msg_time"><?php echo $msg['timestamp']; ?></span>
                </div>
              </div>
              <div style="clear: both;"></div>
          <?php
            }
            // echo "<pre>"; print_r($messages); echo "</pre>";
          }
          ?>
        </div>

        <div class="chat_form_container">
          <form method="post" class="form-inline" action="<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
            <div class="form-group" style="width: 100%;">
              <input class="form-control" rows="2" style="width: 90%;" id="message" name="message" type="text">
              <button class="btn btn-info" type="submit" name="send_message"><?php echo $lang['send']; ?></button>
            </div>
          </form>
        </div>

        <!-- <textarea id="screen" cols="40" rows="10"> </textarea> <br>   -->
        <!-- <input id="message" size="40">
        <button id="button"> Send </button> -->
      </div>
    <?php
    }
    ?>
  </div>
</div>

<script type="text/javascript">
  var employee_id = "<?php echo $_GET['employee_id']; ?>";
  var url = '<?php echo $link->link("get_messages", frontend); ?>';
  var view = '';
  if (employee_id > 0) {
    view = 'getChat';
  }

  var msg_container = $(".messages_container");

  function update() {
    $.post(
      url, {
        view: view,
        employee_id: employee_id
      },
      function(data) {
        if (data != '') {
          $('.messages_container').append(data);
          msg_container.scrollTop(msg_container.prop("scrollHeight"));
        }
      }
    );
    setTimeout('update()', 5000);
  }

  $(document).ready(function() {

    msg_container.scrollTop(msg_container.prop("scrollHeight"));

    $("form").submit(function(e) {
      e.preventDefault();
      $.post(
        url, {
          message: $('#message').val(),
          view: view,
          employee_id: employee_id
        },
        function(data) {
          $('.messages_container').append(data);
          msg_container.scrollTop(msg_container.prop("scrollHeight"));
          $("#message").val("");
        }
      );
    });

    if (view == 'getChat') {
      update();
    }
    // $('#button').click(function(){
    //   $.post(
    //     url,
    //     {
    //       message : $('#message').val(),
    //       view : view,
    //       employee_id : employee_id
    //     },
    //     function(data){
    //       // $("#screen").val(data);
    //       $('.messages_container').append(data);
    //       $("#message").val("");
    //     }
    //   );
    // });

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
      "oLanguage": {
        'sUrl': '//cdn.datatables.net/plug-ins/1.10.19/i18n/<?php echo $_SESSION['site_lang']; ?>.json'
      }
    });
  });
</script>