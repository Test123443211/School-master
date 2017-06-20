<html>
      <head>
        <title>Withdraw Certificate</title>
         
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">

<link rel="shortcut icon" href="assets/images/favicon.png">
<link rel="stylesheet" href="assets/css/font-icons/font-awesome/css/font-awesome.min.css">

<link rel="stylesheet" href="assets/js/vertical-timeline/css/component.css">
<link rel="stylesheet" href="assets/js/datatables/responsive/css/datatables.responsive.css">



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
    <body>
    
<table width="90%" align="center">
    <tr>
        <td>Phone:</td><td align="right">Reg No:<?php echo '2315'?></td>
    </tr>
    
</table>
<table  width="90%" align="center">
    <tr>
        <td height="250px"><image src="uploads/lcertificathead.png" width="100%" height="75%" style="margin-top:-50px;"/></td>
    </tr>
</table>
<br>       <?php 
  $student_info = $this->crud_model->get_withraw_students($student_id);
  $student_info1 = $this->crud_model->get_student_info($student_id);

  foreach ($student_info as $row):
      foreach ($student_info1 as $row1): 
      ?>   
<table align="center"  cellpadding="5" cellspacing="0" width="90%" >
    <tr>
        <td width="5%">Name:</td><td style="border-bottom: 1px solid black" width="26%"><?php echo $row1['name'];?></td>
        <td width="17%">Father Name:</td><td style="border-bottom: 1px solid black"  width="26%"><?php echo $this->db->get_where('parent',  array('parent_id'=>$row1['parent_id']))->row()->name;?></td>
        <td width="5%">DOB:</td><td style="border-bottom: 1px solid black" width="20%"><?php echo $row1['birthday'];?></td>
    </tr>
    <tr>
        <td width="10%">Address:</td><td style="border-bottom: 1px solid black" colspan="3"><?php echo $row1['address'];?></td>
        <td colspan="2">Certified that the  </td>
    </tr>
    <tr><td colspan="6"><p style="line-height:30px;">above mentioned student attended this school upto the _________________ has paid all the dues and was allowed on the above dateable
            to withdraw His/Her name.He she was reading in the ________Class and passed/failed in the examination.He/She was promised for 
            promotion to the class__________ which was given/not given to him/her. The following particulars are certified produced School attended during
            School year.</p></td></tr>
    <?php endforeach;?>
</table>
<br><br>
 <table align="center"  cellpadding="5" cellspacing="0" border="1" width="90%">
        <thead>
            <tr>
                <th>SLC Reason</th>
                <th>Prepared By</th>
                <th>Checked By</th>
                <th>Remarks</th>
                <th>Withdraw Class</th>
                <th>Date of withdrawal</th>
                <th>Dues</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $row['reason'];?></td>
                <td><?php echo $row['prepared_by'];?></td>
                <td><?php echo $row['check_by'];?></td>
                <td><?php echo $row['remarks'];?></td>
                <td><?php echo $this->db->get_where('class', array('class_id'=>$row['withdraw_class']))->row()->name;?></td>
                <td><?php echo $row['withdraw_date']?></td>
                <td><?php echo $row['dues']?></td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
<br><br><br><br>
<table align="center" width="90%">
    <tr>
        <td></td>
        <td style="border-top:1px solid black;" align='right' width='25%'>Principal's Signature</td></tr>
</table>
<link rel="stylesheet" href="assets/js/datatables/responsive/css/datatables.responsive.css">
	<link rel="stylesheet" href="assets/js/select2/select2-bootstrap.css">
	<link rel="stylesheet" href="assets/js/select2/select2.css">
	<link rel="stylesheet" href="assets/js/selectboxit/jquery.selectBoxIt.css">

    </body>	
</html>

