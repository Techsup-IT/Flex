<div id="content-container">
    <div class="pageheader">
        <h3><i><img src="uploads/logo/company_icons/jobs_icon-01.png" style ="width:40px;height:40px;margin:0 10px;"></i><?php echo $lang['list_previous_jobs']; ?></h3>
        <div class="breadcrumb-wrapper">
            <span class="label"><?php echo $lang['you_are_here']; ?>:</span>
            <ol class="breadcrumb">
                <li class="active"><?php echo $lang['list_previous_jobs']; ?></li>
            </ol>
        </div>
    </div>


       


    <div id="page-content">
        <div class="panel">
            <?php echo $display_msg; ?>
            <div class="panel-body">
                <div class="row">
                    <p><h3 class="text-center">jobs evaluation</h3></p>
                    <?php
                    if (isset($previous_jobs) && count($previous_jobs) > 0) {
                        foreach ($previous_jobs as $job) {
                    ?>
                            <div class="col-md-6">
                                <div class="panel">
                                    <div class="panel-body">
                                        <div class="col-md-12 border-bottom pad-5">
                                            <div class="col-md-6 border-right">
                                                <div class="col-md-12 pad-no pad-btm-5">
                                                    <div class="col-md-6 pad-no"><b><?= $lang['project'] ?></b> : </div>
                                                    <div class="col-md-6 pad-no"><?= $job['project_name']; ?></div>
                                                </div>
                                                <div class="col-md-12 pad-no">
                                                    <div class="col-md-6 pad-no"><b><?= $lang['tasks'] ?></b> :</div>
                                                    <div class="col-md-6 pad-no" style="min-height: 50px;">
                                                        <div class="col-md-12 pad-no"><?= str_replace(',', '<br>', $job['task_name']); ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 text-center">
                                                <div class="col-md-12 pad-no"><b><?= $lang['working_hours'] ?></b></div>
                                                <div class="col-md-12 pad-no">
                                                    <?php if ($job['working_hours'] != '') echo gmdate("H:i:s", $job['working_hours']); ?></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 pad-5 pad-top-5">
                                            <div class="col-md-12 pad-btm-5 pad-top-5">
                                                <div class="col-md-6 pad-no"><b><?= $lang['company_name'] ?></b> :  <?= $job['company_name']; ?></div>
                                                <!--<div class="col-md-6 pad-no"><?= $job['company_name']; ?></div>-->
                                            </div>
                                             <div class="col-md-12 pad-btm-5 pad-top-5">
                                                <div class="col-md-6 pad-no"><b>Evaluation</b> :
                                                <!--<div class="col-md-6">-->
                                                <?php
                                                for ($i = 1; $i <= 5; $i++) {
                                                    $star_color = '#d5d5d5d';
                                                    $start_class = 'fa fa-star-o fa-lg';
                                                    if ($job['rating'] != '' && $job['rating'] >= $i) {
                                                        $star_color = '#ff7501';
                                                        $start_class = 'fa fa-star fa-lg ' . $i;
                                                    }
                                                ?>
                                                    <i class="<?= $start_class; ?>" style="color: <?= $star_color; ?>;"></i></span>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>
             
                    <p><h3 class="text-center">Jobs information</h3></p> 
   <!--<div id="page-content">-->
   <!--     <div class="panel">-->
   <!--         <?php echo $display_msg; ?>-->
   <!--         <div class="panel-body">-->
   <!--             <div class="row">-->
                 
   <!--     <table id="company_report" class="table table-striped table-bordered">-->
   <!--       <thead>-->
   <!--         <tr>-->
              
   <!--           <th> <?php echo $lang['company_name']; ?> </th>-->
   <!--           <th> <?php echo $lang['job_title']; ?></th>-->
   <!--           <div class="col-md-12 pad-no">-->
   <!--           <?php if ($exp_details['job_title'] != '') echo gmdate($exp_details['job_title']); ?></div>-->
   <!--           <?php if ($_SESSION['department'] == 3) { ?>-->
   <!--           <th> <?php echo $lang['salaried']; ?> </th>-->
   <!--           <?php } ?>-->
   <!--       </thead>-->
   <!-- </div>-->
   <!-- </div>-->
   <!-- </div>-->
   <!-- </div>-->
   
   <div id="page-content">
        <div class="panel">
            <?php echo $display_msg; ?>
            <div class="panel-heading">
                <h3 class="panel-title"><?php echo $lang['list_previous_jobs']; ?>
                    <?php if (in_array($_SESSION['department'], array(1, 4, 5))) { ?>
                        
                    <?php } ?>
                </h3>

            </div>
            <div class="panel-body">
                <table id="contract_table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th class="min-tablet" width="5%"> <?php echo $lang['company']; ?></th>
                            <th class="min-tablet" width="20%"> <?php echo $lang['job_title']; ?></th>
                            <th class="min-tablet" width="10%"> <?php echo $lang['hour_rate']; ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (is_array($contracts) && count($contracts) > 0) {
                            foreach ($contracts as $contract) { ?>
                                <tr>
                                    <td><?php echo $contract['company_name']; ?></td>
                                    <td><?php echo $contract['job_title']; ?></td>
                                    <td class="text-right"><?php echo $contract['hourly_rate']; ?></td>
                                    <td>
                                        <a href="<?php echo $link->link("view_contract", frontend, '&contract_id=' . $contract['id']); ?>" class="btn btn-success fa fa-eye"></a>
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
         $('#contract_table').DataTable({
            "oLanguage": {
                'sUrl': '//cdn.datatables.net/plug-ins/1.10.19/i18n/<?php echo $_SESSION['site_lang']; ?>.json'
            }
        });
        
    });
    
</script>