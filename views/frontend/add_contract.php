<style>
    #contract_form .chosen-container {
        margin-bottom: 0px;
    }
</style>
<div id="content-container">
    <div class="pageheader hidden-xs">
        <h3><i></i><?php echo $lang['add_contract']; ?></h3>
        <div class="breadcrumb-wrapper">
            <span class="label"><?php echo $lang['you_are_here']; ?>:</span>
            <ol class="breadcrumb">
                <li> <a href="<?php echo $link->link('home', frontend); ?>"> <?php echo $lang['dashboard']; ?> </a> </li>
                <li> <a href="<?php echo $link->link('contracts', frontend); ?>"><?php echo $lang['contracts']; ?> </a> </li>
                <li class="active"><?php echo $lang['add_contract']; ?></li>
            </ol>
        </div>
    </div>
    <div id="page-content">
        <div class="row">
            <?php echo $display_msg; ?>
            <div class="col-sm-12">
                <div class="panel">
                    <div class="panel-heading">
                        <div class="panel-control">
                            <button class="btn btn-default" onclick="goBack()"><i class="fa fa-arrow-circle-left"></i> <?php echo $lang['go_back']; ?></button>
                        </div>
                        <h3 class="panel-title"><?php echo $lang['add_contract']; ?></h3>
                    </div>
                    <form method="post" action="<?php echo $link->link("add_contract", frontend, '&employee_id=' . $eid); ?>" id="contract_form">

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="start_date"><?= $lang['start_date'] ?> : </label>
                                        <input type="text" name="start_date" class="form-control" required placeholder="yyyy-mm-dd">
                                    </div>
                                    <div class="form-group">
                                        <label for="end_date"><?= $lang['end_date'] ?> : </label>
                                        <input type="text" name="end_date" class="form-control" required placeholder="yyyy-mm-dd">
                                    </div>
                                    <div class="form-group">
                                        <label for="job_title"><?= $lang['job_title'] ?> : </label>
                                        <select name="job_title" class="form-control select_job" required>
                                            <option value=""><?= $lang['select_option'] ?></option>
                                            <?php
                                            foreach ($specialities as $specialityID => $speciality) {
                                            ?>
                                                <option value="<?= $specialityID; ?>"><?= $speciality[$_SESSION['site_lang'] . '_Title']; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label for="city_id"><?= $lang['city'] ?> : </label>
                                        <select name="city_id" class="form-control select_city" required>
                                            <option value=""><?= $lang['select_option'] ?></option>
                                            <?php
                                            foreach ($cities as $city_id => $city) {
                                            ?>
                                                <option value="<?= $city_id; ?>"><?= $city['Arabic_Name']; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div> -->
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="hourly_rate"><?= $lang['hour_rate'] ?> : <span class="text-xs">(<?= $lang['hour_rate_limit']; ?>)</span></label>
                                        <input type="text" name="hourly_rate" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="working_hours_per_day"><?= $lang['work_hr_day'] ?>: <span class="text-xs">(<?= $lang['work_hr_day_limit']; ?>)</span></label>
                                        <input type="text" name="working_hours_per_day" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="working_hours_per_week"><?= $lang['work_hr_week'] ?>: <span class="text-xs">(<?= $lang['work_hr_week_limit']; ?>)</span></label>
                                        <input type="text" name="working_hours_per_week" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="working_hours"><?= $lang['work_hr_total'] ?>: <span class="text-xs">(<?= $lang['work_hr_total_limit']; ?>)</span></label>
                                        <input type="text" name="working_hours" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="hidden">
                            <input type="hidden" name="eid" value="<?= $eid; ?>">
                        </div>

                        <div class="panel-footer text-center">
                            <a class="btn btn-warning" href="<?php echo $link->link('contracts', frontend, '&employee_id=' . $eid); ?>"><i class="fa fa-times"></i> <?php echo $lang['cancel']; ?></a>
                            <button class="btn btn-success" type="submit" name="submit_contract"><i class="fa fa-save"></i> <?php echo $lang['submit']; ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.select_job').chosen();
        $('.select_city').chosen();
    });
</script>