<hr />

<?php
$fee_types = $this->db->get('fee_types')->result_array();
?>
<div class="row">
    <div class="col-md-12">

        <!------CONTROL TABS START------>
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
                    <?php echo get_phrase('student_fee_list'); ?>
                </a></li>
            <li>
                <a href="#addclasswise" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('add_fee_class_wise'); ?>
                </a>
            </li>

            <li>
                <a href="#addstudentwise" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('add_fee_single_student'); ?>
                </a>
            </li>
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
                            <th><div><?php echo get_phrase('student'); ?></div></th> 
                            <th><div><?php echo get_phrase('Parent'); ?></div></th> 
                            <th><div><?php echo get_phrase('class'); ?></div></th> 
                            <th><div>Total (Per year)</div></th> 
                            <th><div><?php echo get_phrase('Action'); ?></div></th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        foreach ($student_fee_list as $row):
                            ?>
                            <tr>
                                <td><?php
                                    echo $count;
                                    $count++;
                                    ?>
                                </td>
                                <td><?php
                                    echo $this->db->get_where('student', array(
                                        'student_id' => $row['student_id']
                                    ))->row()->name;
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    $parent_id = $this->db->get_where('student', array(
                                                'student_id' => $row['student_id']
                                            ))->row()->parent_id;
                                    echo $this->db->get_where('parent', array(
                                        'parent_id' => $parent_id
                                    ))->row()->name;
                                    ?>
                                </td>
                                <td><?php
                                    echo $this->db->get_where('class', array(
                                        'class_id' => $row['class_id']
                                    ))->row()->name;
                                    ?>
                                </td>


                                <td>
                                    <?php
                                    $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
                                    $this->db->select_sum('amount');
                                    $this->db->from('student_fee_list');
                                    $this->db->where(array(
                                        'class_id' => $row['class_id'],
                                        'student_id' => $row['student_id'],
                                        'session' => "$year"
                                    ));
                                    $query = $this->db->get();
                                    echo $query->row()->amount;
//                                     
                                    ?>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                            Action <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                                            <!-- EDITING LINK -->
                                            <li>
                                                <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modal_view_student_fee_slip/<?php echo $row['id']; ?>');">
                                                    <i class="entypo-eye"></i>
                                                    <?php echo get_phrase('view'); ?>
                                                </a>
                                            </li>
                                            <!-- EDITING LINK -->
                                            <li>
                                                <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modal_edit_student_fee_slip/<?php echo $row['id']; ?>');">
                                                    <i class="entypo-pencil"></i>
                                                    <?php echo get_phrase('edit'); ?>
                                                </a>
                                            </li>
                                            <li class="divider"></li>

                                            <!-- DELETION LINK -->
                                            <li>
                                                <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>index.php?admin/student_fee_slip/delete/<?php echo $row['id']; ?>');">
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


            <div class="tab-pane box" id="addclasswise">


                <div class="box-content">
                    <?php echo form_open(base_url() . 'index.php?admin/student_fee_slip/create', array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top')); ?>
                    <div class="padded">
                       	<div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('class'); ?></label>
                            <div class="col-sm-6">
                                <select name="class_id" class="form-control selectboxit" required>
                                    <option value=""><?php echo get_phrase('select_class'); ?></option>
                                    <?php
                                    $classes = $this->db->get('class')->result_array();
                                    foreach ($classes as $row):
                                        ?>
                                        <option value="<?php echo $row['class_id']; ?>"><?php echo $row['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>


                        <?php
                        foreach ($fee_types as $row):
                            ?>
                            <div class="form-group">
                                <label for="field-2" class="col-sm-3 control-label"><?php echo $row['name']; ?></label>

                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="amount[<?php echo $row['id']; ?>]" value="" >
                                </div> 
                            </div>
                            <?php
                        endforeach;
                        ?>

                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-info"><?php echo get_phrase('add_fee_slip'); ?></button>
                        </div>
                    </div>
                    </form>                
                </div>
            </div>


            <div class="tab-pane box" id="addstudentwise">
                <?php echo form_open(base_url() . 'index.php?admin/student_fee_slip/studentcreate', array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top')); ?>
                <div class="padded">
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('class'); ?></label>
                        <div class="col-sm-6">

                            <select name="class_id" class="form-control" data-validate="required" id="class_id" 
                                    data-message-required="<?php echo get_phrase('value_required'); ?>"
                                    onchange="return get_class_students(this.value)">
                                <option value=""><?php echo get_phrase('select_class'); ?></option>
                                <?php
                                $classes = $this->db->get('class')->result_array();
                                foreach ($classes as $row):
                                    ?>
                                    <option value="<?php echo $row['class_id']; ?>"><?php echo $row['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('student'); ?></label>
                        <div class="col-sm-6">
                            <select name="student_id" class="form-control" id="section_selector_holder">
                                <option value=""><?php echo get_phrase('select_class_first'); ?></option>

                            </select>
                        </div>
                    </div>
                    <?php
                    foreach ($fee_types as $row):
                        ?>
                        <div class="form-group">
                            <label for="field-2" class="col-sm-3 control-label"><?php echo $row['name']; ?></label>

                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="amount[<?php echo $row['id']; ?>]" value="" >
                            </div> 
                        </div>
                        <?php
                    endforeach;
                    ?>

                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-5">
                        <button type="submit" class="btn btn-info"><?php echo get_phrase('add_student_fee_slip'); ?></button>
                    </div>
                </div>
                </form> 
            </div>
            <!----CREATION FORM ENDS-->

        </div>
    </div>
</div>

<script type="text/javascript">

    jQuery(document).ready(function ($)
    {

        var datatable = $("#table_export").dataTable({
            "sPaginationType": "bootstrap",
            "sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>",
            "oTableTools": {
                "aButtons": [
                    {
                        "sExtends": "xls",
                        "mColumns": [0, 1, 2, 3, 4]
                    },
                    {
                        "sExtends": "pdf",
                        "mColumns": [0, 1, 2, 3, 4]
                    },
                    {
                        "sExtends": "print",
                        "fnSetText": "Press 'esc' to return",
                        "sMessage": "Student Fee slips" ,
                        "fnClick": function (nButton, oConfig) {
//							datatable.fnSetColumnVis(1, false);
                            datatable.fnSetColumnVis(5, false);

                            this.fnPrint(true, oConfig);

                            window.print();

                            $(window).keyup(function (e) {
                                if (e.which == 27) {
//									  datatable.fnSetColumnVis(1, true);
                                    datatable.fnSetColumnVis(5, true);
                                }
                            });
                        },
                    },
                ]
            },
        });

        $(".dataTables_wrapper select").select2({
            minimumResultsForSearch: -1
        });



        var datatable = $("#table_export").dataTable();

        $(".dataTables_wrapper select").select2({
            minimumResultsForSearch: -1
        });
    });


    function get_class_students(class_id) {

        $.ajax({
            url: '<?php echo base_url(); ?>index.php?admin/get_class_students_parents/' + class_id,
            success: function (response)
            {
                jQuery('#section_selector_holder').html(response);
            }
        });

    }










 







</script> 