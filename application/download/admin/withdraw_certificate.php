   <?php 
  $student_info = $this->crud_model->get_withraw_students($student_id);
   // $exams         = $this->crud_model->get_exams();
   foreach ($student_info as $row):
   // foreach ($exams as $row2):

?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary panel-shadow" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title"></div>
            </div>
            <div class="panel-body">
                
                
               <div class="col-md-8">
                   <table class="table table-bordered">
                       <thead>
                        <tr>
                            <td style="text-align: center;">Serial No</td>
                            <td style="text-align: center;">SLC Reason</td>
                            <td style="text-align: center;">Prepared By</td>
                            <td style="text-align: center;">Checked By</td>
                            <td style="text-align: center;">Remarks</td>
                            <td style="text-align: center;">Withdraw Class</td>
                            <td style="text-align: center;">Withdraw Date</td>
                            <td style="text-align: center;">Dues</td>
                            
                        </tr>
                    </thead>
                    <tbody>
                       
                            <tr>
                                <td style="text-align: center;"><?php echo $this->db->get_where('enroll', array('student_id'=>$student_id))->row()->roll; ?></td>
                                <td style="text-align: center;"><?php echo $row['reason']; ?></td>
                                <td style="text-align: center;"><?php echo $row['prepared_by'];?></td>
                                <td style="text-align: center;"><?php echo $row['check_by']?></td>
                                <td style="text-align: center;"><?php echo $row['remarks'];?></td>
                                <td style="text-align: center;"><?php echo $this->db->get_where('class',  array('class_id'=>$row['withdraw_class']))->row()->name;?></td>
                                <td style="text-align: center;"><?php echo $row['withdraw_date']?></td>
                                <td style="text-align: center;"><?php echo $row['dues']?></td>
                               
                            </tr>
                      <?php endforeach;?>
                    </tbody>
                   </table>
                   <a href="<?php echo base_url();?>index.php?admin/withdraw_certificate_print_view/<?php echo $student_id;?>/<?php echo $class_id;?>" 
                        class="btn btn-primary" target="_blank">
                        <?php echo get_phrase('print_certificate');?>
                    </a>

                   
                            
                                
               </div>
               
            </div>
        </div>  
    </div>
</div>