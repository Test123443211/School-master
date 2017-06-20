<?php

 
$student_info = $this->db->get_where('student_fee_list', array(
            'id' => $param2
        ))->result_array();

 
$year=$this->db->get_where('settings', array('type' => 'running_year'))->row()->description;

$fee_types = $this->db->get('fee_types')->result_array();

foreach ($student_info as $row):
    $student_id = $row['student_id'];
    $class_id = $row['class_id'];

endforeach;
 

?>



<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">
                    <i class="entypo-plus-circled"></i>
                  Edit Fees Details of     <?php echo $this->db->get_where('student', array('student_id' => $student_id))->row()->name; ?> 
                </div>
            </div>
            <div class="panel-body">
                  <?php echo form_open(base_url() . 'index.php?admin/student_fee_slip/student_fee_edit/'.$param2, array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top')); ?>
                <div class="padded">
                    
                    <?php
                    foreach ($fee_types as $row):
                        
                         $amount= trim($this->db->get_where(' student_fee_list', array(
                                'class_id' => $class_id,
                                'student_id' => $student_id,
                                'session' => "$year",
                                'fee_type_id' => $row['id'],
                            ))->row()->amount);
                        ?>
                        <div class="form-group">
                            <label for="field-2" class="col-sm-3 control-label"><?php echo $row['name']; ?></label>

                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="amount[<?php echo $row['id']; ?>]" value="<?php echo $amount; ?>"/>
                            </div> 
                        </div>
                        <?php
                    endforeach;
                    ?>

                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-5">
                        <button type="submit" class="btn btn-info"><?php echo get_phrase('edit_student_fee_slip'); ?></button>
                    </div>
                </div>
                </form>
                
            </div>
        </div>
    </div>
</div>