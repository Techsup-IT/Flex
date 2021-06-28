<div id="content-container">
    <div class="pageheader">
        
<h3><i><img src="<?php echo SITE_URL . '/uploads/logo/company_icons/icons_flex-04.png'; ?>" style ="width:40px;height:40px;margin:0 10px;"  alt="Admin Picture"></i><?php echo $lang['admin']; ?></h3>
        <div class="breadcrumb-wrapper">
            <span class="label"><?php echo $lang['you_are_here']; ?>:</span>
            <ol class="breadcrumb">
                <li class="active"><?php echo $lang['admin']; ?></li>
            </ol>
        </div>
    </div>



    <div id="page-content">
        <div class="panel-heading">
            <span class="pull-right">

                <a class="btn btn-primary" style="background-color:#8dd3dd;border-color:#8dd3dd;" href="<?php echo $link->link('add_admin', frontend); ?>"><i class="fa fa-plus"></i> Add Admin</a>
            </span>
        </div>


        <?php echo $display_msg; ?>

        <div class="row">
            <table id="example1" class="cell-border example1 table table-striped table1 delSelTable">
                <thead>
                    <tr>
                        <th><?php echo $lang['id']; ?></th>
                        <th><?php echo $lang['name']; ?></th>
                        <th><?php echo $lang['email']; ?></th>
                        <th width="20%"><?php echo $lang['action']; ?></th>
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
        var url = '<?php echo $link->link("get_admin", frontend); ?>';
        var table = $('#example1').DataTable({
            // dom: 'lfBrtip',
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