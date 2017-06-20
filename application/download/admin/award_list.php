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




    <form method="post" class="form-inline">
        <div class="col-xs-2">
            <div class="form-group">

                <div class="col-xs-10">

                    <select name="class_id" class="form-control" data-validate="required" id="class_id" 
                            onchange="return get_class_subjects(this.value)" 
                            data-message-required="<?php echo get_phrase('value_required'); ?>" >
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


        <div class="col-xs-2">
            <div class="form-group">

                <div class="col-xs-10">
                    <select name="subject_id" class="form-control" id="section_selector_holder">
                        <option value=""><?php echo get_phrase('select_class_first'); ?></option>

                    </select>
                </div>
            </div>
        </div>


        <div class="col-xs-3">
            <div class="form-group">

                <div class="col-xs-10">
                    <select name="exam_id" class="form-control ">
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
        <div class="col-xs-3">
            <div class="form-group">

                <div class="col-xs-10">
                    <input type="text" name="time"  class="form-control" id="timeinput" placeholder="Time">
                </div>
            </div>
        </div>
        <div class="col-xs-2">
            <div class="form-group">
                <div class="col-xs-10">
                    <button type="submit" class="btn btn-info"><?php echo get_phrase('Generate'); ?></button>
                </div>
            </div>
        </div>

    </form>

</div>


<?php
if ($class_id != '' && $exam_id != '' && $subject_id != '') :



    $students = $this->db->get_where('enroll', array('class_id' => $class_id, 'year' => $year))->result_array();
    $class_name = $this->db->get_where('class', array('class_id' => $class_id))->row()->name;
    $exam_name = $this->db->get_where('exam', array('exam_id' => $exam_id))->row()->name;
    $subject_name = $this->db->get_where('subject', array('subject_id' => $subject_id))->row()->name;
    ?>
    <div class="row">
        <hr/>
        <span class="pull-right">
            <a onClick="PrintElem('#awardlistdiv')" class="btn btn-default btn-icon icon-left hidden-print pull-right">
                Print   Award List
                <i class="entypo-print"></i>
            </a>
        </span>
    </div>

    <div class="row" id="awardlistdiv">
        <div class="col-xs-12 text-center">
            <h4> <b><?php echo strtoupper($system_name); ?> </b></h4> 

            <div class="row">
                <div class="col-xs-3 text-left">
                    Subject <b> :  <u>  <?php echo $subject_name ?> </u></b>   <br/><br/>
                    Exam <b> :  <u>  <?php echo $exam_name ?> </u></b> 
                </div>
                <div class="col-xs-6 text-center">
                    <img src="<?php echo 'uploads/logo.png'; ?>" height="50" alt="" />
                </div>

                <div class="col-xs-3 text-right">  
                    Class <b> :  <u>  <?php echo $class_name ?> </u></b> <br/><br/>
                    Time <b> :  <u>  <?php echo $time ?> </u></b>   

                </div>
            </div>

            <div class="row">
                <h4> <b>Award List </b></h4> 
                <hr/>
            </div>
            <div class="row">

                <table class="table table-bordered" style="color: black">
                    <tr>
                        <td style="border-left-width: medium; width: 10%">R.No </td> 
                        <td style="width:30%">Name </td> 
                        <td style="border-right-width: medium; width: 10%">Obt Marks </td> 
                        <td style="border-left-width: medium; width: 10%">R.No </td> 
                        <td style="width:30%">Name </td> 
                        <td style="width: 10%">Obt Marks </td> 
                    </tr>




                    <?php
                    $totalStudent = count($students);
                    $stdNumber = $totalStudent % 2 == 0 ? 0 : 1;
                    $i = 0;
                    foreach ($students as $row) {
                        $student_id = $row['student_id'];

                        $studentName = $this->db->get_where('student', array('student_id' => $student_id))->row()->name;

                        $roll_no = $this->db->get_where('roll_numbers', array('class_id' => $class_id, 'exam_id' => $exam_id, 'student_id' => $student_id))->row()->roll_no;
                        if ($i % 2 == 0) {
                            ?>
                            <tr>
                                <td><?php echo $roll_no ?> </td> <td><b> <?php echo $studentName ?> </b>   </td> <td>   </td>
                                <?php
                            } else {
                                ?>

                                <td> <?php echo $roll_no ?> </td> <td> <b> <?php echo $studentName ?> </b>  </td> <td>   </td>
                            </tr>

                            <?php
                        }
                        $i++;
                    }

                    if ($stdNumber != 0) {
                        ?>
                        <td> </td> <td>  </td> <td>   </td>
                        </tr>
                        <tr>
                           <td> </td> <td>  </td> <td>   </td>
                           <td> </td> <td>  </td> <td>   </td>
                        </tr>
                        <?php
                    } else {
                        ?>

                        <?php
                    }
                    ?>
                </table>
                <b> Teacher Name: </b> ___________________   <br/>
               <b> Sign : </b>___________________
            </div>
        </div>

    </div>
    <?php
endif;
?>

<script type="text/javascript">


    function get_class_subjects(class_id) {

        $.ajax({
            url: '<?php echo base_url(); ?>index.php?admin/get_class_subject/' + class_id,
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
        var mywindow = window.open('', 'award list', 'height=400,width=600');
        mywindow.document.write('<html><head><title>Award List</title>');

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