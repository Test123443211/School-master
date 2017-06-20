
<?php 
    $student_info = $this->crud_model->get_student_info($student_id);
    //$class_info= $this->crud_model->get_class_name($class_id);
    foreach ($student_info as $row1):
  //  foreach ($class_info as $row2):    
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
                            <td style="text-align: center;">Name</td>
                            <td style="text-align: center;">Father Name</td>
                            <td style="text-align: center;">Date Of Birth</td>
                            <td style="text-align: center;">DOB In words</td>
                            <td style="text-align: center;">Permanent Address</td>
                            <td style="text-align: center;">Religion</td>
                            <td style="text-align: center;">Nationality</td>
                            <td style="text-align: center;">Guardian Name</td>
                            <td style="text-align: center;">Present Class</td>
                        </tr>
                    </thead>
                    <tbody>
                       
                            <tr>
                                <td style="text-align: center;"><?php echo $row1['name'];?></td>
                                <td style="text-align: center;"><?php echo $this->db->get_where('parent',  array('parent_id'=>$row1['parent_id']))->row()->name;?></td>
                                <td style="text-align: center;"><?php echo $row1['birthday'];?></td>
                                <td style="text-align: center;"><?php echo $row1['dob_in_words'];?></td>
                                <td style="text-align: center;"><?php echo $row1['address'];?></td>
                                <td style="text-align: center;"><?php echo $row1['relegion'];?></td>
                                <td style="text-align: center;">Pakistani</td>
                                <td style="text-align: center;">Ahmad</td>
                                <td style="text-align: center;"><?php echo $class_name = $this->db->get_where('class', array('class_id' => $class_id))->row()->name;?></td>
                            </tr>
                        <?php endforeach;?>
                            <?php //endforeach;?>
                    </tbody>
                   </table>
                   <a href="<?php echo base_url();?>index.php?admin/student_certificate_print_view/<?php echo $student_id;?>" 
                        class="btn btn-primary" target="_blank">
                        <?php echo get_phrase('print_certificate');?>
                    </a>

                   
                            
                                
               </div>
               
            </div>
        </div>  
    </div>
</div>