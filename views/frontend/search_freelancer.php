<style>
    .ui-autocomplete {
        list-style: none;
        background: #fff;
        padding: 0px;
        max-width: 100ch !important;
        max-height: 300px !important;
        overflow-y: scroll;
    }

    .ui-menu-item {
        padding: 10px;
        cursor: pointer;
        background-color: #fff;
        border-bottom: 1px solid #d4d4d4;
    }

    .ui-menu-item:hover {
        background-color: #e9e9e9;
    }
</style>
<div id="content-container">
    <div class="pageheader">
        <h3><i><img src="<?php echo SITE_URL . '/uploads/logo/company_icons/icons_flex-05.png'; ?>" style ="width:40px;height:40px;margin:0 10px;"  alt="Search Picture"></i><?php echo $lang['search_freelancer']; ?></h3>
        <div class="breadcrumb-wrapper">
            <span class="label"><?php echo $lang['you_are_here']; ?>:</span>
            <ol class="breadcrumb">
                <li class="active"><?php echo $lang['search_freelancer']; ?></li>
            </ol>
        </div>
    </div>

    <div id="page-content">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10 text-center">
                <form action="<?php $link->link("edit_freelancer", frontend); ?>" id="freelancer_search_form" method="post">
                    <div class="input-group input-group-lg">
                        <span class="input-group-btn">
                            <span class="btn btn-default">
                                <i class="fa fa-search"></i>
                            </span>
                        </span>
                        <input type="text" id="search_box" name="search_speciality" class="form-control" placeholder="<?= $lang['search_freelancer'] ?>" value="<?= $_POST['search_speciality']; ?>" required>
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-filter"></i>
                                &nbsp;&nbsp;<?= $lang['filter']; ?>&nbsp;
                                <span class="caret"></span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="pad-5">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="search_price"><?= $lang['price'] ?></label>
                                            <input type="text" class="form-control" id="search_price" name="search_price" value="<?= $_POST['search_price']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-12 pad-btm border-bottom">
                                        <div class="form-group">
                                            <label for="search_work_exp"><?= $lang['year_exp'] ?></label>
                                            <input type="text" class="form-control" id="search_work_exp" name="search_work_exp" value="<?= $_POST['search_work_exp']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-12 pad-top">
                                        <div class="form-group">
                                            <button class="btn btn-success filter_data" type="submit"><?= $lang['done']; ?></button>
                                            <button class="btn btn-default filter_clear" type="button"><?= $lang['cancel']; ?></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-1"></div>
        </div>
        <br />
        <?php
        if ($is_search) {
        ?>
            <div class="panel">
                <?php echo $display_msg; ?>
                <div class="panel-body">
                    <div class="row">
                        <?php
                        if (isset($freelancers) && count($freelancers) > 0) {
                            foreach ($freelancers as $freelancer) {
                        ?>
                                <div class="col-md-6">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <div class="col-md-12 text-center text-bold text-lg pad-ver-10">
                                                <?= $lang['freelancer'] . " " . $lang['id'] . " : " . $freelancer['employee_id'] ?>
                                            </div>
                                        </div>
                                        <div class="panel-body">
                                            <div class="col-md-12 pad-5">
                                                <div class="col-md-6 border-right">
                                                    <div class="col-md-12 pad-no pad-btm-5">
                                                        <div class="col-md-6 pad-no"><b><?= $lang['speciality'] ?></b> : </div>
                                                        <div class="col-md-6 pad-no"><?= $specialities_map[$freelancer['speciality']]; ?></div>
                                                    </div>
                                                    <div class="col-md-12 pad-no">
                                                        <div class="col-md-12 pad-no"><b><?= $lang['skills'] ?></b> :</div>
                                                        <div class="col-md-12 pad-no" style="min-height: 50px;">
                                                            <div class="col-md-12"><?= str_replace(',', '<br>', $freelancer['skills']); ?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="col-md-12 pad-no pad-btm-5">
                                                        <div class="col-md-6 pad-no"><b><?= $lang['hour_rate'] ?></b> : </div>
                                                        <div class="col-md-6 pad-no"><?= $freelancer['hourly_rate'] . "$"; ?></div>
                                                    </div>
                                                    <div class="col-md-12 pad-no">
                                                        <div class="col-md-12 pad-no"><b><?= $lang['work_exp'] ?></b> :</div>
                                                        <div class="col-md-6 pad-no" style="min-height: 50px;">
                                                            <div class="col-md-12"><?= str_replace(',', '<br>', $freelancer['job_title']); ?></div>
                                                        </div>
                                                        <div class="col-md-6 pad-no" style="min-height: 50px;">
                                                            <div class="col-md-12"><?= str_replace(',', ' Yr. <br>', $freelancer['years_of_exp'] . ","); ?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            if (isset($freelancers_eval) && isset($freelancers_eval[$freelancer['employee_id']])  && count($freelancers_eval[$freelancer['employee_id']]) > 0) {
                                                foreach ($freelancers_eval[$freelancer['employee_id']] as $job) {
                                            ?>
                                                    <div class="col-md-12 pad-5 border-top pad-top-5">
                                                        <div class="col-md-6 pad-no"><b><?= $job['company_name']; ?> | <?= $job['project_name']; ?></b></div>
                                                        <div class="col-md-6 pad-no text-center">
                                                            <?php
                                                            if ($job['rating'] != '' && $job['rating'] != 0) {
                                                                for ($i = 1; $i <= 10; $i++) {
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
                                                            } else {
                                                                echo "NA";
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                        } else {
                            ?>
                            <div class="col-md-12 text-center text-bold">
                                <?= $lang['no_record_found']; ?>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {
        var specialities = <?php echo json_encode($specialities, true); ?>;
        $('#search_box').autocomplete({
            source: specialities,
            autoFocus: true,
            minLength: 2,
            select: function(event, ui) {
                if (ui.item && ui.item.value != '') {
                    $('#search_box').val(ui.item.value);
                    $('#freelancer_search_form').submit();
                }
            }
        });

        $('.filter_clear').click(function() {
            $('#search_price').val('');
            $('#search_work_exp').val('');
        });

        $('#freelancer_search_form').submit(function() {
            var speciality = $('#search_box').val();
            if (speciality == '' || speciality == null || speciality == undefined) {
                return false;
            }
            return true;
        });
    });
</script>