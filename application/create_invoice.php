<?php
?><hr />

<div class="row">
    <div class="col-md-12 col-xs-12">

        <!------CONTROL TABS START------>
        <ul class="nav nav-tabs bordered">
            <li class="  <?php echo $class_id2 != '' ? "" : "active" ?>">
                <a href="#student_wise" data-toggle="tab"><i class="entypo-menu"></i> 
                    <?php echo get_phrase('student_wise'); ?>
                </a></li>
            <li  class="  <?php echo $class_id2 != '' ? "active" : "" ?>">
                <a href="#classwise" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('class_wise'); ?>
                </a>
            </li>

        </ul>

        <!------CONTROL TABS END------>
        <div class="tab-content">
            <br>            
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box  <?php echo $class_id2 != '' ? "" : "active" ?>" id="student_wise">

                <?php echo form_open(base_url() . 'index.php?admin/create_invoice/', array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top')); ?>

                <div class="panel panel-primary">
                    <div class="panel-body">

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


                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                                <button type="submit" class="btn btn-info"><?php echo get_phrase('create_inovice'); ?></button>
                            </div>
                        </div>
                    </div>
                </div>
                </from>
                <?php
                if ($class_id != '' && $student_id != ''):
                    $year = $this->db->get_where('settings', array(
                                'type' => 'running_year'
                            ))->row()->description;

                    $studentName = $this->db->get_where('student', array('student_id' => $student_id))->row()->name;

                    $parent_id = $this->db->get_where('student', array(
                                'student_id' => $student_id
                            ))->row()->parent_id;
                    $parentName = $this->db->get_where('parent', array(
                                'parent_id' => $parent_id
                            ))->row()->name;
                    $fileid = date("dmy") . $student_id;
                    ?>
                    <span class="pull-right">
                        <a onClick="PrintElem('#studentwisepanel')" class="btn btn-default btn-icon icon-left hidden-print pull-right">
                            Print  Payment  Detail 
                            <i class="entypo-print"></i>
                        </a>
                    </span>
                    <div id="studentwisepanel">
                        <div  style="font-size:7px; color: black">
                            <style type="text/css">
                                td{
                                    padding: 1px !important;
                                }
                                th{
                                    padding: 1px !important;
                                }
                            </style>


                            <div class="text-uppercase text-center">
                                <span class="pull-left">
                                    <?php echo $fileid ?>
                                </span>
                                <span class="bold ">
                                    Payment Detail of 
                                    <b><?php echo ucfirst($studentName) . " S/O " . ucfirst($parentName) ?> 

                                        &nbsp; &nbsp; &nbsp; Class: <?php echo $this->db->get_where('class', array('class_id' => $class_id))->row()->name; ?>
                                        &nbsp; &nbsp; &nbsp;  Session: <?php echo $year; ?>
                                    </b>
                                </span>  
                            </div>




                            <div class="row" style="border-bottom: 1px black dashed">

                                <div class="col-sm-3 col-xs-3">
                                    <?php
                                    $fee_types = $this->db->get('fee_types')->result_array();
                                    ?>

                                    <table class="table table-bordered table-condensed"  style="font-size:7px; color: black">

                                        <tr class="bg-primary text-center">
                                            <td colspan="3"> Fees Detail </td>
                                        </tr>
                                        <tr>
                                            <th> Sr# </th>
                                            <th> <?php echo get_phrase('type'); ?> </th>
                                            <th> <?php echo get_phrase('amount'); ?> </th> 

                                        </tr>

                                        <tbody>

                                            <?php
                                            $total_fees = 0;
                                            $count = 1;
                                            foreach ($fee_types as $rowtypes):
                                                ?>
                                                <tr>
                                                    <td><?php
                                                        echo $count;
                                                        $count++;
                                                        ?> </td>

                                                    <td> <?php echo $rowtypes ['name'] ?></td>

                                                    <td> <?php
                                                        $amount = $this->db->get_where(' student_fee_list', array(
                                                                    'class_id' => $class_id,
                                                                    'student_id' => $student_id,
                                                                    'session' => "$year",
                                                                    'fee_type_id' => $rowtypes['id'],
                                                                ))->row()->amount;
                                                        echo $amount;
                                                        $total_fees +=$amount;
                                                        ?> 
                                                    </td>
                                                </tr>
                                                <?php
                                            endforeach;
                                            ?> 
                                            <tr class="bg-primary">
                                                <td colspan="2"><b> Total </b></td> 
                                                <td><?php echo $total_fees ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    Signature : ______________
                                </div>


                                <div class="col-sm-4 col-xs-4">

                                    <?php
                                    $student_transaction = $this->db
                                                    ->get_where('student_transaction', array(
                                                        'class_id' => $class_id,
                                                        'student_id' => $student_id,
                                                        'session' => $year
                                                    ))->result_array();
                                    ?>

                                    <table class = "table table-bordered table-condensed" style="font-size:7px; color: black" >

                                        <tr class="bg-primary text-center">
                                            <td colspan="4">
                                                Transaction Detail  
                                            </td>
                                        </tr>

                                        <tr>
                                            <th> Sr#</th>

                                            <th><?php echo get_phrase('due_date'); ?></th>
                                            <th><?php echo get_phrase('payment'); ?></th>
                                            <th><?php echo get_phrase('remarks'); ?></th> 

                                        </tr>

                                        <tbody>

                                            <?php
                                            $total_paid = 0;
                                            $count = 1;
                                            foreach ($student_transaction as $payment):
                                                ?>
                                                <tr>
                                                    <td> <div> <?php
                                                            echo $count;
                                                            $count++;
                                                            ?> </div> </td>
                                                    <td> <?php echo date("d-m-Y", strtotime($payment ['due_date'])) ?>       </td>
                                                    <td> <?php
                                                        echo $payment ['payment'];
                                                        $total_paid +=$payment ['payment'];
                                                        ?>        
                                                    </td>

                                                    <td> <?php echo $payment['remarks'] ?>       </td> 
                                                </tr>
                                                <?php
                                            endforeach;
                                            ?>  
                                            <tr class="bg-primary text-center text-capitalize">
                                                <td colspan="2"> Total</td>
                                                <td colspan="2"><?php echo $total_paid ?></td>
                                            </tr>

                                            <tr>
                                                <td><?php echo $count; ?>  </td>
                                                <td>  </td> <td>  </td> <td>  </td>

                                            </tr>
                                        </tbody>
                                    </table>


                                    Stamp: ______________
                                </div>


                                <div class="col-sm-2 col-xs-2">

                                    <h4 class="text-center">Summery </h4>

                                    <table class = "table table-bordered  table-condensed" style="font-size:7px; color: black">
                                        <tr>
                                            <td> Total Amount </td>
                                            <td> <?php echo $total_fees ?> </td>
                                        </tr>
                                        <tr>
                                            <td> Paid Amount </td>
                                            <td> <?php echo $total_paid ?> </td>
                                        </tr>
                                        <tr class="bg-primary">
                                            <td> Remaining </td>
                                            <td> <?php echo $total_fees - $total_paid ?> </td>
                                        </tr>
                                    </table>

                                    Remaining :______________
                                </div>


                                <div class="col-sm-3 col-xs-3" style="border-left:  1px black dashed">

                                    <b class="text-center"><?php echo $fileid ?>   &nbsp;For Office Only </b> <br/>
                                    <?php echo ucfirst($studentName) . " S/O " . ucfirst($parentName) ?> 

                                    &nbsp; &nbsp; &nbsp; Class: <?php echo $this->db->get_where('class', array('class_id' => $class_id))->row()->name; ?>
                                    &nbsp; &nbsp; &nbsp;  Session: <?php echo $year; ?>

                                    <table class = "table table-bordered  table-condensed" style="font-size:7px; color: black">
                                        <tr>
                                            <td> Total </td>
                                            <td> <?php echo $total_fees ?> </td>
                                        </tr>
                                        <tr>
                                            <td> Paid </td>
                                            <td> <?php echo $total_paid ?> </td>
                                        </tr>
                                        <tr class="bg-primary">
                                            <td> Remaining </td>
                                            <td> <?php echo $total_fees - $total_paid ?> </td>
                                        </tr>
                                        <tr class="">
                                            <td> Due Date </td>
                                            <td>   </td>
                                        </tr>
                                        <tr class="">
                                            <td> Payment </td>
                                            <td>   </td>
                                        </tr>
                                        <tr class="">
                                            <td> Remarks </td>
                                            <td>   </td>
                                        </tr>
                                    </table>


                                </div>
                            </div>


                        </div>
                    </div>
                    <?php
                endif;
                ?>



            </div>


            <div class="tab-pane box   <?php echo $class_id2 != '' ? "active" : "" ?>   " id="classwise">
                <div class="panel panel-primary">
                    <div class="panel-body">
                        <form action="<?php base_url() . 'index.php?admin/create_invoice/' ?>" class="form-horizontal form-groups-bordered validate" method="post" accept-charset="utf-8">
                            <div class="padded">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo get_phrase('class'); ?></label>
                                    <div class="col-sm-6">

                                        <select name="class_id2" class="form-control" data-validate="required" id="class_id2" 
                                                data-message-required="<?php echo get_phrase('value_required'); ?>" >
                                            <option value=""><?php echo get_phrase('select_class'); ?></option>
                                            <?php
                                            $classes = $this->db->get('class')->result_array();
                                            foreach ($classes as $row):
                                                ?>
                                                <option value="<?php echo $row['class_id']; ?>"><?php echo $row['name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <br/>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-5">
                                    <button type="submit" class="btn btn-info"><?php echo get_phrase('create_inovice'); ?></button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="panel panel-primary">
                    <div class="panel-body">
                        <?php
                        if ($class_id2 != ''):
                            ?>
                            <span class="pull-right">
                                <a onClick="PrintElem('#classtwisepanel')" class="btn btn-default btn-icon icon-left hidden-print pull-right">
                                    Print  Payment  Detail 
                                    <i class="entypo-print"></i>
                                </a>
                            </span>
                            <div id="classtwisepanel">
                                <div  style="font-size:7px; color: black">
                                    <style type="text/css">
                                       
                                        @media print{
                                            *{
                                                color: black !important;
                                            }
                                             td{
                                            padding: 1px !important;
                                        }
                                        th{
                                            padding: 1px !important;
                                        }
                                        }
                                    </style>

                                    <?php
                                    $year = $this->db->get_where('settings', array(
                                                'type' => 'running_year'
                                            ))->row()->description;
                                    $students = $this->db->get_where('enroll', array(
                                                'class_id' => $class_id2, 'year' => $year))->result_array();


                                    foreach ($students as $row) {


                                        $student_id = $row['student_id'];

                                        $studentName = $this->db->get_where('student', array('student_id' => $student_id))->row()->name;

                                        $parent_id = $this->db->get_where('student', array(
                                                    'student_id' => $student_id
                                                ))->row()->parent_id;
                                        $parentName = $this->db->get_where('parent', array(
                                                    'parent_id' => $parent_id
                                                ))->row()->name;
                                        $fileid = date("dmy") . $student_id;
                                        ?>
                                        <br/>
                                        <div class="text-uppercase text-center">
                                            <span class="pull-left">
                                                <?php echo $fileid ?>
                                            </span>
                                            <span class="bold ">
                                                Payment Detail of 
                                                <b><?php echo ucfirst($studentName) . " S/O " . ucfirst($parentName) ?> 

                                                    &nbsp; &nbsp; &nbsp; Class: <?php echo $this->db->get_where('class', array('class_id' => $class_id2))->row()->name; ?>
                                                    &nbsp; &nbsp; &nbsp;  Session: <?php echo $year; ?>
                                                </b>
                                            </span>  
                                        </div>




                                        <div class="row" style="border-bottom: 1px black dashed">

                                            <div class="col-sm-3 col-xs-3">
                                                <?php
                                                $fee_types = $this->db->get('fee_types')->result_array();
                                                ?>

                                                <table class="table table-bordered table-condensed"  style="font-size:7px; color: black">

                                                    <tr class="bg-primary text-center">
                                                        <td colspan="3"> Fees Detail </td>
                                                    </tr>
                                                    <tr>
                                                        <th> Sr# </th>
                                                        <th> <?php echo get_phrase('type'); ?> </th>
                                                        <th> <?php echo get_phrase('amount'); ?> </th> 

                                                    </tr>

                                                    <tbody>

                                                        <?php
                                                        $total_fees = 0;
                                                        $count = 1;
                                                        foreach ($fee_types as $rowtypes):
                                                            ?>
                                                            <tr>
                                                                <td><?php
                                                                    echo $count;
                                                                    $count++;
                                                                    ?> </td>

                                                                <td> <?php echo $rowtypes ['name'] ?></td>

                                                                <td> <?php
                                                                    $amount = $this->db->get_where(' student_fee_list', array(
                                                                                'class_id' => $class_id2,
                                                                                'student_id' => $student_id,
                                                                                'session' => "$year",
                                                                                'fee_type_id' => $rowtypes['id'],
                                                                            ))->row()->amount;
                                                                    echo $amount;
                                                                    $total_fees +=$amount;
                                                                    ?> 
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        endforeach;
                                                        ?> 
                                                        <tr style="color: #fff;    background-color: #949494;">
                                                            <td colspan="2"><b> Total </b></td> 
                                                            <td><?php echo $total_fees ?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                Signature : ______________
                                            </div>


                                            <div class="col-sm-4 col-xs-4">

                                                <?php
                                                $student_transaction = $this->db
                                                                ->get_where('student_transaction', array(
                                                                    'class_id' => $class_id2,
                                                                    'student_id' => $student_id,
                                                                    'session' => $year
                                                                ))->result_array();
                                                ?>

                                                <table class = "table table-bordered table-condensed" style="font-size:7px; color: black" >

                                                    <tr class=" text-center" style="color: #fff;    background-color: #949494;">
                                                        <td colspan="4">
                                                            Transaction Detail  
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th> Sr#</th>

                                                        <th><?php echo get_phrase('due_date'); ?></th>
                                                        <th><?php echo get_phrase('payment'); ?></th>
                                                        <th><?php echo get_phrase('remarks'); ?></th> 

                                                    </tr>

                                                    <tbody>

                                                        <?php
                                                        $total_paid = 0;
                                                        $count = 1;
                                                        foreach ($student_transaction as $payment):
                                                            ?>
                                                            <tr>
                                                                <td> <div> <?php
                                                                        echo $count;
                                                                        $count++;
                                                                        ?> </div> </td>
                                                                <td> <?php echo date("d-m-Y", strtotime($payment ['due_date'])) ?>       </td>
                                                                <td> <?php
                                                                    echo $payment ['payment'];
                                                                    $total_paid +=$payment ['payment'];
                                                                    ?>        
                                                                </td>

                                                                <td> <?php echo $payment['remarks'] ?>       </td> 
                                                            </tr>
                                                            <?php
                                                        endforeach;
                                                        ?>  
                                                        <tr class="bg-primary text-center text-capitalize">
                                                            <td colspan="2"> Total</td>
                                                            <td colspan="2"><?php echo $total_paid ?></td>
                                                        </tr>

                                                        <tr>
                                                            <td><?php echo $count; ?>  </td>
                                                            <td>  </td> <td>  </td> <td>  </td>

                                                        </tr>
                                                    </tbody>
                                                </table>


                                                Stamp:__________________
                                            </div>


                                            <div class="col-sm-2 col-xs-2">

                                                <h4 class="text-center">Summery </h4>

                                                <table class = "table table-bordered  table-condensed" style="font-size:7px; color: black">
                                                    <tr>
                                                        <td> Total Amount </td>
                                                        <td> <?php echo $total_fees ?> </td>
                                                    </tr>
                                                    <tr>
                                                        <td> Paid Amount </td>
                                                        <td> <?php echo $total_paid ?> </td>
                                                    </tr>
                                                    <tr style="color: #fff;    background-color: #949494;">
                                                        <td> Remaining </td>
                                                        <td> <?php echo $total_fees - $total_paid ?> </td>
                                                    </tr>
                                                </table>

                                                Remaining :______________
                                            </div>


                                            <div class="col-sm-3 col-xs-3" style="border-left:  1px black dashed">

                                                <b class="text-center"><?php echo $fileid ?>   &nbsp;For Office Only </b> <br/>
                                                <?php echo ucfirst($studentName) . " S/O " . ucfirst($parentName) ?> 

                                                &nbsp; &nbsp; &nbsp; Class: <?php echo $this->db->get_where('class', array('class_id' => $class_id2))->row()->name; ?>
                                                &nbsp; &nbsp; &nbsp;  Session: <?php echo $year; ?>

                                                <table class = "table table-bordered  table-condensed" style="font-size:7px; color: black">
                                                    <tr>
                                                        <td> Total </td>
                                                        <td> <?php echo $total_fees ?> </td>
                                                    </tr>
                                                    <tr>
                                                        <td> Paid </td>
                                                        <td> <?php echo $total_paid ?> </td>
                                                    </tr>
                                                    <tr style="color: #fff;    background-color: #949494;">
                                                        <td> Remaining </td>
                                                        <td> <?php echo $total_fees - $total_paid ?> </td>
                                                    </tr>
                                                    <tr class="">
                                                        <td> Due Date </td>
                                                        <td>   </td>
                                                    </tr>
                                                    <tr class="">
                                                        <td> Payment </td>
                                                        <td>   </td>
                                                    </tr>
                                                    <tr class="">
                                                        <td> Remarks </td>
                                                        <td>   </td>
                                                    </tr>
                                                </table>


                                            </div>
                                        </div>



                                        <?php
                                    }
                                endif;
                                ?>

                            </div>

                        </div>
                    </div>
                </div> 
            </div>


        </div>
    </div>
</div>


<script type="text/javascript">

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
<script type="text/javascript">
    // print invoice function
    function PrintElem(elem)
    {
        Popup($(elem).html());
    }

    function Popup(data)
    {
        var mywindow = window.open('', 'invoice', 'height=400,width=600');
        mywindow.document.write('<html><head><title>Invoice</title>');

        mywindow.document.write('<link rel="stylesheet" href="assets/css/bootstrap.css" type="text/css" />');
        mywindow.document.write('<link rel="stylesheet" href="assets/css/neon-theme.css" type="text/css" />');
        mywindow.document.write('<link rel="stylesheet" href="assets/css/neon-forms.css" type="text/css" />');
        mywindow.document.write('<link rel="stylesheet" href="assets/js/datatables/responsive/css/datatables.responsive.css" type="text/css" />');
        mywindow.document.write('</head><body>');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

       setInterval(function () {
                mywindow.document.close();
                mywindow.focus();
                mywindow.print();
                mywindow.close();
            }, 100);
    }
</script>