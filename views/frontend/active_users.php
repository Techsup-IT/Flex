<div id="content-container">
          <div class="pageheader">
                        <h3><i class="fa fa-user"></i><?php echo $lang['active_users']; ?></h3>
                        <div class="breadcrumb-wrapper">
                             <span class="label"><?php echo $lang['you_are_here']; ?>:</span>  <ol class="breadcrumb">
                                 <li class="active"><?php echo $lang['active_users']; ?></li>
                            </ol>
                        </div>
                    </div>



                    <div id="page-content">
                   <div class="panel-heading">
                            <span class="pull-right"></span>
                        </div> 
                                 
                         
                        <?php echo $display_msg;?> 

                        <div class="row">
                            <table id="example1" class="cell-border example1 table table-striped table1 delSelTable">
                                <thead>
                                    <tr>
                                        <th><?php echo $lang['id']; ?></th>
                                        <th><?php echo $lang['name']; ?></th>
                                        <th><?php echo $lang['company']; ?></th>
                                        <th><?php echo $lang['email']; ?></th>
                                        <th><?php echo $lang['ip_address']; ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php 
                                  if(isset($users) && count($users) > 0){
                                    foreach ($users as $user) {
                                      ?>
                                      <tr>
                                        <td><?php echo $user['employee_id']; ?></td>
                                        <td><?php echo $user['emp_name'].' '.$user['emp_surname']; ?></td>
                                        <td><?php echo $user['company_name']; ?></td>
                                        <td><?php echo $user['email']; ?></td>
                                        <td><?php echo $user['ip_address']; ?></td>
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
          dom: 'lfBrtip',
          "iDisplayLength": 25,
      });
  });
</script>