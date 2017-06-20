<hr />
<div class="row">
    <div class="col-md-12">

        <!------CONTROL TABS START------>
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
                    <?php echo get_phrase('holidays_list'); ?>
                </a></li>
            <li>
                <a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('add_holiday'); ?>
                </a></li>
        </ul>
        <!------CONTROL TABS END------>
        <div class="tab-content">
            <br>            
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">

                <table class="table table-bordered datatable" id="table_export">
                    <thead>
                        <tr>
                            <th><div><?php echo get_phrase('sr#'); ?></div></th>
                            <th><div><?php echo get_phrase('title'); ?></div></th> 
                            <th><div><?php echo get_phrase('from_date'); ?></div></th> 
                            <th><div><?php echo get_phrase('to_date'); ?></div></th>   
                            <th><div><?php echo get_phrase('action'); ?></div></th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        foreach ($holidays as $row):
                            ?>
                            <tr>
                                <td> <?php
                                    echo $count;
                                    $count++;
                                    ?>  </td>
                                <td><?php echo $row['title']; ?></td>
                                <td><?php echo date("d-m-Y",strtotime($row['from_date'])); ?></td>
                                <td><?php echo date("d-m-Y",strtotime($row['to_date'])); 
                                   
//                                    $to_date = strtotime("+$number_days day", strtotime($row['from_date']));
//                                    date('d-M-Y', $to_date);
                                    ?></td>
                               
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                            Action <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                                            <!-- EDITING LINK -->
                                            <li>
                                                <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modal_edit_holidays/<?php echo $row['id']; ?>');">
                                                    <i class="entypo-pencil"></i>
                                                    <?php echo get_phrase('edit'); ?>
                                                </a>
                                            </li>
                                            <li class="divider"></li>

                                            <!-- DELETION LINK -->
                                            <li>
                                                <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>index.php?admin/holidays/delete/<?php echo $row['id']; ?>');">
                                                    <i class="entypo-trash"></i>
                                                    <?php echo get_phrase('delete'); ?>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!----TABLE LISTING ENDS--->


            <!----CREATION FORM STARTS---->
            <div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                    <?php echo form_open(base_url() . 'index.php?admin/holidays/create', array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top')); ?>
                    <div class="padded">

                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('title'); ?></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="title" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('from_date'); ?></label>
                            <div class="col-sm-5">
                                <input type="text" class="datepicker form-control" data-date-format="dd-mm-yyyy" name="from_date" value=""/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('to_date'); ?></label>
                            <div class="col-sm-5"> 
                                    <input type="text" class="datepicker form-control"  name="to_date" value=""/>
                            
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-info"><?php echo get_phrase('add_holiday'); ?></button>
                        </div>
                    </div>
                    </form>                
                </div>                
            </div>
            <!----CREATION FORM ENDS-->

        </div>
    </div>
</div>


<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      
<script type="text/javascript">

    jQuery(document).ready(function ($)
    {


        var datatable = $("#table_export").dataTable();

        $(".dataTables_wrapper select").select2({
            minimumResultsForSearch: -1
        });
    });

</script> 