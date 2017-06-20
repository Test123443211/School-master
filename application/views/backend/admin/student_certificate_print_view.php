<html>
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
    </style>
    <body style="background-image: url('uploads/back.png'); background-position: center;">
  
      <?php 
    $student_info = $this->crud_model->get_student_info($student_id);
   // $exams         = $this->crud_model->get_exams();
    foreach ($student_info as $row1):
   // foreach ($exams as $row2):
?>
<table width="100%" align="center">
    <tr>
        <td>Phone:</td><td align="right">Reg No:<?php echo $this->db->get_where('enroll', array('student_id'=>$student_id))->row()->roll;?></td>
    </tr>
    
</table>
<table  width="100%" align="center">
    <tr>
        <td height="250px"><image src="uploads/certificathead.png" width="100%" height="75%" style="margin-top:-50px;"/></td>
    
</table>
<table  width="100%" align="center">
    <tr>
        <td width="25%"><b>DATE: </b><?php echo "<u>".$row1['admission_date']."</u>";?></td>
        <td colspan="4" align='right'><b>Roll No:<b> <u><?php echo $this->db->get_where('enroll', array('student_id'=> $student_id))->row()->roll;?></u></td>
    </tr>
    <tr>
        <td width="25%">Name (in block letters)Mr/Miss:</td> <td width="15%" colspan="4" style="border-bottom:solid 1px black"><?php echo $row1['name'];?></td>
        
    </tr>
    <tr>
        <td width="30%">Father's Name (in block letters):</td> <td colspan="4" style="border-bottom:solid 1px black"><?php echo$this->db->get_where('parent',  array('parent_id'=>$row1['parent_id']))->row()->name;?></td>
        
    </tr>
    <tr>
        <td><b>Date Of Birth(in fig):</b></td><td style="border-bottom:solid 1px black"><?php echo $row1['birthday'];?></td>
        <td align='' width='15%' colspan='2'><b>In Words:</b></td> <td style="border-bottom:solid 1px black"><?php echo $row1['dob_in_words'];?></td>
        
    </tr>
    <tr>
        <td><b>Place Of Birth:</b></td> <td colspan="4" style="border-bottom:solid 1px black"><?php echo $row1['address'];?></td>
        
    </tr>
    <tr>
        <td><b>Permanent Address:</b></td> <td colspan="4" style="border-bottom:solid 1px black"><?php echo $row1['address'];?></td>
        
    </tr>
    <tr>
        <td><b>Religion:</b></td> <td style="border-bottom:solid 1px black"><?php echo $row1['relegion'];?></td>
        <td colspan='2' width=''><b>Nationality:</b></td> <td style="border-bottom:solid 1px black"><?php echo 'Pakistani';?></td>
       
    </tr>
    <tr>
        <td><b>Occupation:</b></td> <td style="border-bottom:solid 1px black"><?php echo $this->db->get_where('parent',  array('parent_id'=>$row1['parent_id']))->row()->profession;?></td>
        <td colspan='2'><b>Guardian's Name:</b></td> <td style="border-bottom:solid 1px black"><?php echo $this->db->get_where('parent',  array('parent_id'=>$row1['parent_id']))->row()->guardian_name;?></td>
        
    </tr>
    <tr>
        
        
        <td><b>Phone Res:</b></td> <td style="border-bottom:solid 1px black"><?php echo $row1['phone'];?></td>
        <td colspan='2' width=''><b>Present/Previous Class:</b></td> <td style="border-bottom:solid 1px black"><?php echo $this->db->get_where('class',  array('class_id'=>$class_id))->row()->name;?></td>
        
    </tr>
    </table>
        <br>
<hr width='100%'>
<table  width='100%' align='center'>
    
    <tr><td colspan='3' align='center'><b>Affidavit</b></td></tr>
    <tr>
        <td valign="top"><b>1.</b></td>
        <td colspan="2"><p><b> I here by under take that my Son/Daughter shall abide by the rules and regulation
            of the Islamia Children Academy.I agree to with draw my Son/Daughter when ever Islamia Children Academy fined that
            He/She is not obeying the rules and regulation.</b></p>
           
            </td>
    </tr> 
    <tr>
        <td valign="top"><b>2.</b></td>
        <td><b><p>The School Authorities have the power to impose my penalty in case of any undesired behavior by my Son/Daughter wardian 
            course of study.
            </b></p></td>
        
    </tr>
    <tr>
        <td colspan="2" align="right" style="text-decoration: overline;">Parent's/Guardian's Signature</td>
        
            
    </tr>
</table>
<hr width='100%'>
<table  align='center' width='100%' cellspacing="15">
    <tr align='center'><td colspan="2">For Office Use Only</td></tr>
    <tr>
        <td colspan="2">Islamia Children Academy Committee remarks___________________________________</td>
    </tr>
    <tr align='right'>
        <td colspan="2">Vice Principal(I.C.A)____________</td>
    </tr>
    <tr>
        <td>Class Teacher________________________</td><td>Checked by_______________________________</td>
    </tr>
    <tr >
        <td>Accountant__________________________</td><td>Principal(I.C.A)___________________________</td>
    </tr>
</table>
   <?php endforeach;?>
    </body>
</html>