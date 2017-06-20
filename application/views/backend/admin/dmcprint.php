<html>
    <head>
        <title>DMC</title>
         
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">

<?php
    $skin_colour = $this->db->get_where('settings' , array(
        'type' => 'skin_colour'
    ))->row()->description; 
    if ($skin_colour != ''):?>

    <link rel="stylesheet" href="assets/css/skins/<?php echo $skin_colour;?>.css">

<?php endif;?>

<?php if ($text_align == 'right-to-left') : ?>
    <link rel="stylesheet" href="assets/css/neon-rtl.css">
<?php endif; ?>
<script src="assets/js/jquery-1.11.0.min.js"></script> 




        <!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<link rel="shortcut icon" href="assets/images/favicon.png">
<link rel="stylesheet" href="assets/css/font-icons/font-awesome/css/font-awesome.min.css">

<link rel="stylesheet" href="assets/js/vertical-timeline/css/component.css">
<link rel="stylesheet" href="assets/js/datatables/responsive/css/datatables.responsive.css">


<!--Amcharts-->
<script src="<?php echo base_url();?>assets/js/amcharts/amcharts.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/amcharts/pie.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/amcharts/serial.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/amcharts/gauge.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/amcharts/funnel.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/amcharts/radar.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/amcharts/exporting/amexport.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/amcharts/exporting/rgbcolor.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/amcharts/exporting/canvg.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/amcharts/exporting/jspdf.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/amcharts/exporting/filesaver.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/amcharts/exporting/jspdf.plugin.addimage.js" type="text/javascript"></script>


       
            <style>
            .container{
                width:900px; margin: 0px auto;
                background-image: url('logo1.PNG')!important; 
                background-color: CDF6DE;
                background-repeat: no-repeat;
                background-position: center;
            }
            @media print
{
    * {-webkit-print-color-adjust:exact;}
}
        

    .exam_chart {
    width           : 100%;
        height      : 265px;
        font-size   : 11px;
}
  


        </style>
    </head>
    <?php 
    $student_info = $this->crud_model->get_student_info($student_id);
    $exams         = $this->crud_model->get_exam_info($exam_id);
    foreach ($student_info as $row1):
    foreach ($exams as $row2):
?>

    <?php
	$class_name		 	= 	$this->db->get_where('class' , array('class_id' => $class_id))->row()->name;
	$exam_name  		= 	$this->db->get_where('exam' , array('exam_id' => $exam_id))->row()->name;
	$system_name        =	$this->db->get_where('settings' , array('type'=>'system_name'))->row()->description;
    $running_year       =   $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;
    ?>
    <body style="margin: 0px; padding: 0px;">
        
        <div class="bg print" style="width:900px;  background-position: center; background-image:url('uploads/dmcback.png'); margin: 0px auto; border-top: 5px solid #CDF6DE; background-color:CDF6DE;   background-repeat: no-repeat; background-position: center;">
            <!--<p style="padding-top:5px;"></p>
            <h1 style="margin-bottom:-33px; " align='center'>SHAHEEN MODEL HIGH SCHOOL WARI DIR UPPER</h1><br>
            <h3 style="margin-bottom:-33px;" align='center'> HIGHER SECONDARY SCHOOL CERTIFICATE EXAMINATION </h3><br>
            <h3 style="margin-bottom:-33px;" align='center'>Detailed Marks Certificate</h3>
            <p></p><br>-->
            <table  width="100%" align="center" >
            <tr>
                <td height="250px" valign="bottom"><image src="uploads/dmchead1.png" width="100%" height="100%" style="margin-top:-50px;"/></td>
            </tr>
            <tr><td><p align='center'>
                <strong>  <?php echo "Exam ". $exam_name.' Session '. $running_year ?></strong>
                    </p></td></tr>
        </table>
            <table align="center" cellpadding="5" cellspacing="0"  width="100%">
                <td>
            <p>
                <strong>Roll No :</strong>
                <u><em><?php echo $this->db->get_where('enroll',  array('student_id'=>$student_id,'class_id'=>$class_id,'year'=>$running_year))->row()->roll;?></em></u>
                <br>
                <strong>Class :</strong>
                <u><em><?php echo $class_name;?></em></u>
                <br>
                <strong>Name :</strong>
                <u><em><?php echo $this->db->get_where('student' , array('student_id' => $student_id))->row()->name;?></em></u>
                <br>
                <strong>Father Name :</strong>
                <u><em><?php echo $this->db->get_where('parent',  array('parent_id'=>$row1['parent_id']))->row()->name;?></em></u>
                <br>
                <strong>Appeared As :</strong>
                <u><em>
            Regular Student of Islamia Children Academy, Distt: Dir(U) Chukiatan.   </em></u>
                <br>
        </p>
        </td>
        <td><img src="<?php echo $this->crud_model->get_image_url('student',$row1['student_id']);?>" class="img-circle" width="90" height="100" style="border:1px solid black;"/></td>
            </table>
        <table align="center"  cellpadding="5" cellspacing="0" border="1" width="100%">
       
    <tbody>
       
            <tr>
                <td width="218" rowspan="3"> Subjects</td>
                <td colspan="6" align="center"> Marks Obtained</td>
                
            </tr>
            <tr>
                <td rowspan="2" width="59" align="center">Total Marks</td>
                <td colspan="2" align="center"><?php echo $class_name;?></td>
                <td rowspan="2" align="center" width="86">Obtain Marks</td>
                <td rowspan="2" width="281">In Words</td>
            </tr>
            <tr>
                <td align="center" width="86">Theory</td>
                <td align="center" width="96">Practical</td>
            </tr>
             <?php 
                $total_marks = 0;
                $total_grade_point = 0;
                
                
                
                $subjects = $this->db->get_where('subject' , array(
                    'class_id' => $class_id , 'year' => $running_year
                 ))->result_array();
                 foreach ($subjects as $row3):
                 ?>
            <tr>
                <td><?php echo $row3['name'];?></td>
                <td style="text-align: center;">
                    <?php
                        $obtained_mark_query = $this->db->get_where('mark' , array(
                                                    'subject_id' => $row3['subject_id'],
                                                        'exam_id' => $exam_id,
                                                            'class_id' => $class_id,
                                                                'student_id' => $student_id , 
                                                                    'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description
                                                ));
                        if($obtained_mark_query->num_rows() > 0){
                            $marks = $obtained_mark_query->result_array();
                            foreach ($marks as $row4) {
                                echo $row4['mark_total'];
                                $ttotal_marks += $row4['mark_total'];
                            }
                        }
                    ?>
                </td>
                <td style="text-align: center;">
                    <?php
                        $obtained_mark_query = $this->db->get_where('mark' , array(
                                                    'subject_id' => $row3['subject_id'],
                                                        'exam_id' => $exam_id,
                                                            'class_id' => $class_id,
                                                                'student_id' => $student_id , 
                                                                    'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description
                                                ));
                        if($obtained_mark_query->num_rows() > 0){
                            $marks = $obtained_mark_query->result_array();
                            foreach ($marks as $row4) {
                                echo $row4['mark_obtained'];
                               // $total_marks += $row4['mark_obtained'];
                            }
                        }
                    ?>
                </td>
                <td></td>
                <td style="text-align: center;">
                    <?php
                        $obtained_mark_query = $this->db->get_where('mark' , array(
                                                    'subject_id' => $row3['subject_id'],
                                                        'exam_id' => $exam_id,
                                                            'class_id' => $class_id,
                                                                'student_id' => $student_id , 
                                                                    'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description
                                                ));
                        $obt_marks=0;
                        if($obtained_mark_query->num_rows() > 0){
                            $marks = $obtained_mark_query->result_array();
                            foreach ($marks as $row4) {
                                echo $obt_marks= $row4['mark_obtained'];
                                $total_marks += $row4['mark_obtained'];
                            }
                        }
                    ?>
                </td>
                <td><?php echo $this->crud_model->convertNumberToWord($obt_marks);?></td>
            </tr>
            <?php endforeach;?>
            <tr>
                <td>Total Marks Alloted</td>
                <td align="center"><?php echo $ttotal_marks;?></td>
                <td align="center" colspan="2" rowspan="1">Total Marks Obtained</td>
                <td align="center"><?php echo $total_marks;?></td>
                <td><?php echo $this->crud_model->convertNumberToWord($total_marks);?> </td>
            </tr>
            <tr>
                <td colspan="3">--</td>
                <td>Remarks</td>
                <td colspan="2">--</td>
            </tr>
    </tbody>
   </table>
      
       
        <!--<link rel="stylesheet" href="assets/css/bootstrap.css">--> 
        <div style="margin-left:10%; width: 80%; margin-right: 10%;">
                   <div id="chartdiv<?php echo $row2['exam_id'];?>" class="exam_chart"></div>
                       <script type="text/javascript">
                            var chart<?php echo $row2['exam_id'];?> = AmCharts.makeChart("chartdiv<?php echo $row2['exam_id'];?>", {
                                "theme": "none",
                                "type": "serial",
                                "dataProvider": [
                                        <?php 
                                            foreach ($subjects as $subject) :
                                        ?>
                                        {
                                            "subject": "<?php echo $subject['name'];?>",
                                            "mark_obtained": 
                                            <?php
                                                $obtained_mark = $this->crud_model->get_obtained_marks( $row2['exam_id'] , $class_id , $subject['subject_id'] , $row1['student_id']);
                                                echo $obtained_mark;
                                            ?>,
                                            "mark_highest": 
                                            <?php
                                                $highest_mark = $this->crud_model->get_highest_marks( $row2['exam_id'] , $class_id , $subject['subject_id'] );
                                                echo $highest_mark;
                                            ?>
                                        },
                                        <?php 
                                            endforeach;

                                        ?>
                                    
                                ],
                                "valueAxes": [{
                                    "stackType": "3d",
                                    "unit": "%",
                                    "position": "left",
                                    "title": "Obtained Mark vs Highest Mark"
                                }],
                                "startDuration": 1,
                                "graphs": [{
                                    "balloonText": "Obtained Mark in [[category]]: <b>[[value]]</b>",
                                    "fillAlphas": 0.9,
                                    "lineAlpha": 0.2,
                                    "title": "2004",
                                    "type": "column",
                                    "fillColors":"#7f8c8d",
                                    "valueField": "mark_obtained"
                                }, {
                                    "balloonText": "Highest Mark in [[category]]: <b>[[value]]</b>",
                                    "fillAlphas": 0.9,
                                    "lineAlpha": 0.2,
                                    "title": "2005",
                                    "type": "column",
                                    "fillColors":"#34495e",
                                    "valueField": "mark_highest"
                                }],
                                "plotAreaFillAlphas": 0.1,
                                "depth3D": 20,
                                "angle": 45,
                                "categoryField": "subject",
                                "categoryAxis": {
                                    "gridPosition": "start"
                                },
                                "exportConfig":{
                                    "menuTop":"20px",
                                    "menuRight":"20px",
                                    "menuItems": [{
                                        "format": 'png'   
                                    }]  
                                }
                            });
                    </script>
        </div>
               </div>
              <?php
    endforeach;
        endforeach;
?> 
    </body>
    <link rel="stylesheet" href="assets/js/datatables/responsive/css/datatables.responsive.css">
	<link rel="stylesheet" href="assets/js/select2/select2-bootstrap.css">
	<link rel="stylesheet" href="assets/js/select2/select2.css">
	<link rel="stylesheet" href="assets/js/selectboxit/jquery.selectBoxIt.css">

   	<!-- Bottom Scripts -->
	<script src="assets/js/gsap/main-gsap.js"></script>
	<script src="assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
	<script src="assets/js/bootstrap.js"></script>
	<script src="assets/js/joinable.js"></script>
	<script src="assets/js/resizeable.js"></script>
	<script src="assets/js/neon-api.js"></script>
	<script src="assets/js/toastr.js"></script>
    <script src="assets/js/jquery.validate.min.js"></script>
	<script src="assets/js/fullcalendar/fullcalendar.min.js"></script>
    <script src="assets/js/bootstrap-datepicker.js"></script>
    <script src="assets/js/fileinput.js"></script>
    
    <script src="assets/js/jquery.dataTables.min.js"></script>
	<script src="assets/js/datatables/TableTools.min.js"></script>
	<script src="assets/js/dataTables.bootstrap.js"></script>
	<script src="assets/js/datatables/jquery.dataTables.columnFilter.js"></script>
	<script src="assets/js/datatables/lodash.min.js"></script>
	<script src="assets/js/datatables/responsive/js/datatables.responsive.js"></script>
    <script src="assets/js/select2/select2.min.js"></script>
    <script src="assets/js/selectboxit/jquery.selectBoxIt.min.js"></script>

    
	<script src="assets/js/neon-calendar.js"></script>
	<script src="assets/js/neon-chat.js"></script>
	<script src="assets/js/neon-custom.js"></script>
	<script src="assets/js/neon-demo.js"></script>
</html>