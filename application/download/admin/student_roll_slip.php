<?php
$year = $this->db->get_where('settings', array(
            'type' => 'running_year'
        ))->row()->description;
$classes = $this->db->get('class')->result_array();
$exams = $this->db->get_where('exam', array(
            'year' => $year
        ))->result_array();
?><hr />

<div class="row">
    <div class="col-md-12 col-xs-12">

        <!------CONTROL TABS START------>
        <ul class="nav nav-tabs bordered">

            <li  class="  <?php echo ($class_id == '' && $class_id2 == '') ? "active" : "" ?>">
                <a href="#exam_roll_no" data-toggle="tab"><i class="entypo-book"></i>
                    <?php echo get_phrase('info'); ?>
                </a>
            </li>

            <li class="  <?php echo $class_id != '' ? "active" : "" ?>">
                <a href="#student_wise" data-toggle="tab"><i class="entypo-menu"></i> 
                    <?php echo get_phrase('student_wise'); ?>
                </a></li>
            <li  class="  <?php echo $class_id2 != '' ? "active" : "" ?>">
                <a href="#classwise" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('class_wise'); ?>
                </a>
            </li>
            <li>
                <a href="#create_roll_no" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('create_roll_no'); ?>
                </a>
            </li>
        </ul>

        <!------CONTROL TABS END------>
        <div class="tab-content">
            <br>            
            <!----TABLE LISTING STARTS-->
            <?php
            /*
             * SELECT *  FROM  `roll_numbers`  WHERE SESSION =  '2016-2017' GROUP BY exam_id
             * SELECT COUNT( * ) AS countt, R.exam_id, R.roll_no as start_roll, R.class_id as start_class
              FROM  `roll_numbers` AS R
              WHERE SESSION =  "2016-2017"
              GROUP BY exam_id
              LIMIT 0 , 30
             */

            $this->db->select('COUNT( * ) AS countt, R.exam_id, R.roll_no as start_roll, R.class_id as start_class');
            $this->db->from('roll_numbers as R');
            $this->db->where("R.session='$year'");
            $this->db->group_by('exam_id');
            $examlist = $this->db->get()->result_array();
            ?>

            <div class="tab-pane box  <?php echo ($class_id == '' && $class_id2 == '') ? "active" : "" ?>" id="exam_roll_no">
                <table class="table table-bordered ">
                    <thead>
                    <th>  Exam</th>
                    <th>  Start Class</th>
                    <th>  Start Roll No</th>
                    <th>  Total Student</th>
                    </thead>
                    <?php
                    foreach ($examlist as $exam) {
                        ?>
                        <tr>
                            <td>  <?php
                                echo $this->db->get_where('exam', array('exam_id' => $exam['exam_id']))->row()->name
//                            echo $exam['exam_id'];
                                ?>  
                            </td>
                            <td>  <?php
                                echo $this->db->get_where('class', array('class_id' => $exam['start_class']))->row()->name;
                                ?>    </td>
                            <td>  <?php echo $exam['start_roll'] ?>     </td>
                            <td>  <?php echo $exam['countt'] ?>    </td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>

            </div>
            <div class="tab-pane box  <?php echo $class_id != '' ? "active" : "" ?>" id="student_wise">


                <div class="panel panel-primary">

                    <div class="panel-body">
                        <?php echo form_open(base_url() . 'index.php?admin/student_roll_slip/', array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top')); ?>

                        <div class="col-sm-3 ">
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('class'); ?></label>
                                <div class="col-sm-6">

                                    <select name="class_id" class="form-control" data-validate="required" id="class_id" 
                                            data-message-required="<?php echo get_phrase('value_required'); ?>"
                                            onchange="return get_class_students(this.value)">
                                        <option value=""><?php echo get_phrase('select_class'); ?></option>
                                        <?php
                                        foreach ($classes as $row):
                                            ?>
                                            <option value="<?php echo $row['class_id']; ?>"><?php echo $row['name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('student'); ?></label>
                                <div class="col-sm-6">
                                    <select name="student_id" class="form-control" id="section_selector_holder">
                                        <option value=""><?php echo get_phrase('select_class_first'); ?></option>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="field-2" class="col-sm-3 "><?php echo get_phrase('exam'); ?></label>
                                <div class="col-sm-8">
                                    <select name="exam" class="form-control " onchange="form_submit()">
                                        <option value=""><?php echo get_phrase('exam'); ?></option>
                                        <?php
                                        foreach ($exams as $row):
                                            ?>
                                            <option value="<?php echo $row['exam_id']; ?>">
                                                <?php echo $row['name']; ?>
                                            </option>
                                            <?php
                                        endforeach;
                                        ?>
                                    </select>
                                </div> 
                            </div>
                        </div>


                        <div class="col-sm-3">

                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-5">
                                    <button type="submit" class="btn btn-info"><?php echo get_phrase('create_roll_slip'); ?></button>
                                </div>
                            </div>
                        </div>
                        </from>

                    </div>
                </div>


                <?php
                if ($class_id != '' && $exam_id != '') :


                    $studentName = $this->db->get_where('student', array('student_id' => $student_id))->row()->name;

                    $parent_id = $this->db->get_where('student', array(
                                'student_id' => $student_id
                            ))->row()->parent_id;

                    $parentName = $this->db->get_where('parent', array(
                                'parent_id' => $parent_id
                            ))->row()->name;
                    ?>
                    <span class="pull-right">
                        <a onClick="PrintElem('#studentwisepanel')" class="btn btn-default btn-icon icon-left hidden-print pull-right">
                            Print  Payment  Detail 
                            <i class="entypo-print"></i>
                        </a>
                    </span>
                    <div id="studentwisepanel">
                        <div  style="font-size:10px; color: black">
                            <style type="text/css">
                                th, td{
                                    padding: 1px !important;
                                } 
                            </style>


                            <div class="text-uppercase text-center">
                                <h6> 
                                    Date Sheet   of

                                    <b><?php echo ucfirst($studentName) . " S/O " . ucfirst($parentName) ?>


                                        <span style="border: 0px 1px; padding: 5px " class="pull-right">R.NO : <?php
                                            echo $this->db->get_where('roll_numbers', array('class_id' => $class_id, 'exam_id' => $exam_id, 'student_id' => $student_id))->row()->roll_no;
                                            ?>  </span>
                                        <br/>
                                        &nbsp; &nbsp; &nbsp; Class: <?php echo $this->db->get_where('class', array('class_id' => $class_id))->row()->name; ?>
                                        &nbsp; &nbsp; &nbsp;  Session: <?php echo $year; ?>
                                        &nbsp; &nbsp; &nbsp;   Exam  : <?php echo $this->db->get_where('exam', array('exam_id' => $exam_id))->row()->name ?>
                                    </b>

                                </h6>
                            </div>




                            <div class="row" style="border-bottom: 1px black dashed">

                                <div class="col-sm-12 col-xs-12">


                                    <table  class="table table-bordered text-center" id="">

                                        <tbody>

                                            <?php
                                            $subjects = $this->db->get_where('time_table', array(
                                                        'class_id' => $class_id,
                                                        'exam_id' => $exam_id,
                                                        'year' => $this->db->get_where('settings', array(
                                                            'type' => 'running_year'
                                                        ))->row()->description
                                                    ))->result_array();

                                            $first_time = '';
                                            $second_time = '';
                                            ?>

                                            <tr>
                                                <?php
                                                foreach ($subjects as $row):
                                                    ?>
                                                    <td colspan="2"><?php echo date('d-M-y', strtotime($row['date'])); ?></td>

                                                    <?php
                                                    $first_time = $row['first_time'];
                                                    $second_time = $row['second_time'];
                                                endforeach;
                                                ?> 
                                            </tr>
                                            <tr>
                                                <?php
                                                for ($i = 0; $i < count($subjects); $i++) {
                                                    ?>
                                                    <td><?php echo $first_time ?></td>
                                                    <td> <?php echo $second_time ?></td>
                                                    <?php
                                                }
                                                ?>
                                            </tr>

                                            <tr>
                                                <?php
                                                foreach ($subjects as $row):
                                                    //$date = strtotime($row['date'])
                                                    ?>
                                                    <td><?php echo $row['first_subject']; ?></td>
                                                    <td><?php echo $row['second_subject']; ?></td>

                                                <?php endforeach; ?> 

                                            </tr>

                                        </tbody>
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
                        <form action="<?php base_url() . 'index.php?admin/student_roll_slip/' ?>" class="form-horizontal form-groups-bordered validate" method="post" accept-charset="utf-8">


                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo get_phrase('class'); ?></label>
                                    <div class="col-sm-6">

                                        <select name="class_id2" class="form-control" data-validate="required" id="class_id2" 
                                                onchange="return get_class_students2(this.value)" 
                                                data-message-required="<?php echo get_phrase('value_required'); ?>" >
                                            <option value=""><?php echo get_phrase('select_class'); ?></option>
                                            <?php
                                            foreach ($classes as $row):
                                                ?>
                                                <option value="<?php echo $row['class_id']; ?>"><?php echo $row['name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <br/>
                                    </div>
                                </div>

                            </div>



                            <div class="col-sm-4">

                                <div class="form-group">
                                    <label for="field-2" class="col-sm-3 "><?php echo get_phrase('exam'); ?></label>
                                    <div class="col-sm-8">
                                        <select name="exam2" class="form-control " onchange="form_submit()">
                                            <option value=""><?php echo get_phrase('exam'); ?></option>
                                            <?php
                                            foreach ($exams as $row):
                                                ?>
                                                <option value="<?php echo $row['exam_id']; ?>">
                                                    <?php echo $row['name']; ?>
                                                </option>
                                                <?php
                                            endforeach;
                                            ?>
                                        </select>
                                    </div> 
                                </div>


                            </div>
                            <div class="col-sm-4">

                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-5">
                                        <button type="submit" class="btn btn-info"><?php echo get_phrase('create_roll_no'); ?></button>
                                    </div>
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
                                    Print   Date Sheet  
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
                                        ?>

                                        <div class="text-uppercase text-center">
                                            <h6> 
                                                Date Sheet   of

                                                <b>
                                                    <?php echo ucfirst($studentName) . " S/O " . ucfirst($parentName) ?> 
                                                    &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp;
                                                    <span style="border: 0px 1px; padding: 5px" class="pull-right">R.NO : <?php
                                                        echo $this->db->get_where('roll_numbers', array('class_id' => $class_id2, 'exam_id' => $exam_id, 'student_id' => $student_id))->row()->roll_no;
                                                        ?>  </span> 
                                                    <br/>
                                                    &nbsp; &nbsp; &nbsp; Class: <?php echo $this->db->get_where('class', array('class_id' => $class_id2))->row()->name; ?>
                                                    &nbsp; &nbsp; &nbsp;  Session: <?php echo $year; ?>
                                                    &nbsp; &nbsp; &nbsp;   Exam  : <?php echo $this->db->get_where('exam', array('exam_id' => $exam_id))->row()->name ?>

                                                </b>

                                            </h6>
                                        </div>




                                        <div class="row" style="border-bottom: 1px black dashed">

                                            <div class="col-sm-12 col-xs-12">


                                                <table  class="table table-bordered text-center" id="">

                                                    <tbody>

                                                        <?php
                                                        $subjects = $this->db->get_where('time_table', array(
                                                                    'class_id' => $class_id2,
                                                                    'exam_id' => $exam_id,
                                                                    'year' => $this->db->get_where('settings', array(
                                                                        'type' => 'running_year'
                                                                    ))->row()->description
                                                                ))->result_array();

                                                        $first_time = '';
                                                        $second_time = '';
                                                        ?>

                                                        <tr>
                                                            <?php
                                                            foreach ($subjects as $row):
                                                                ?>
                                                                <td colspan="2"><?php echo date('d-M-y', strtotime($row['date'])); ?></td>

                                                                <?php
                                                                $first_time = $row['first_time'];
                                                                $second_time = $row['second_time'];
                                                            endforeach;
                                                            ?> 
                                                        </tr>
                                                        <tr>
                                                            <?php
                                                            for ($i = 0; $i < count($subjects); $i++) {
                                                                ?>
                                                                <td><?php echo $first_time ?></td>
                                                                <td> <?php echo $second_time ?></td>
                                                                <?php
                                                            }
                                                            ?>
                                                        </tr>

                                                        <tr>
                                                            <?php
                                                            foreach ($subjects as $row):
                                                                //$date = strtotime($row['date'])
                                                                ?>
                                                                <td><?php echo $row['first_subject']; ?></td>
                                                                <td><?php echo $row['second_subject']; ?></td>

                                                            <?php endforeach; ?> 

                                                        </tr>

                                                    </tbody>
                                                </table>

                                            </div>

                                        </div>
                                        <?php
                                    }
                                    ?>

                                </div>

                            </div>

                            <?php
                        endif;
                        ?>
                    </div>
                </div> 
            </div>

            <div class="tab-pane box  " id="create_roll_no">
                <form action="<?php echo base_url() . 'index.php?admin/student_roll_slip/create_roll_no' ?>
                      " class="form-horizontal validate"  method="post" accept-charset="utf-8">
                    <div class="col-sm-8 col-sm-offset-2">
                        <div class="form-group">
                            <label for="field-2" class="col-sm-2 "><?php echo get_phrase('exam'); ?></label>
                            <div class="col-sm-6">
                                <select name="exam" class="form-control">
                                    <option value=""><?php echo get_phrase('exam'); ?></option>
                                    <?php
                                    foreach ($exams as $row):
                                        ?>
                                        <option value="<?php echo $row['exam_id']; ?>">
                                            <?php echo $row['name']; ?>
                                        </option>
                                        <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div> 
                        </div>

                        <div class="form-group">
                            <label for="field-2" class="col-sm-2 "><?php echo get_phrase('sorting'); ?></label>
                            <div class="col-sm-6">
                                <select name="sorting" class="form-control">
                                    <option value=""><?php echo get_phrase('select_sort'); ?></option>
                                    <option  value="ascending ">Ascending (K.G to 10) </option>
                                    <option  value="descending  ">Descending  (10 to K.G) </option>         
                                </select>
                            </div> 
                        </div>

                        <!--                        <div class="form-group">
                                                    <label for="field-2" class="col-sm-2 "><?php echo get_phrase('type'); ?></label>
                                                    <div class="col-sm-6">
                                                        <select name="create_type" class="form-control">
                                                            <option value=""><?php echo get_phrase('select_type'); ?></option>
                                                            <option  value="all">All School (K.G to 10)</option>
                                                            <option  value="level">Level Wise  (Primary, Middel, High) </option>         
                                                        </select>
                                                    </div> 
                                                </div>-->

                        <div class="form-group">
                            <label for="field-2" class="col-sm-2 "><?php echo get_phrase('starting'); ?></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="starting" value="1">
                            </div> 
                        </div>


                        <button type="submit" class="btn btn-primary pull-right">Create </button>
                    </div>




                </form>

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


        $.ajax({
            url: '<?php echo base_url(); ?>index.php?admin/get_class_section/' + class_id,
            success: function (response)
            {
                jQuery('#section_selector_holdersection').html(response);
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
        mywindow.document.write('<html><head><title>Student Roll No</title>');

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