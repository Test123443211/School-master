<?php 

$edit_data		=	$this->db->get_where('enroll' , array(

	'student_id' => $param2 , 'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description

))->result_array();

foreach ($edit_data as $row):

?>

<?php echo $status = $this->db->get_where('student' , array('student_id' => $param2))->row()->status;?>



<div class="row">

	<div class="col-md-12">

            <div class="panel panel-primary" data-collapsed="0">

        	<div class="panel-heading">

            	<div class="panel-title" >

            		<i class="entypo-plus-circled"></i>

					<?php echo get_phrase('Withdraw_Student');?>

            	</div>

                </div>

			<div class="panel-body">

				

                <?php echo form_open(base_url() . 'index.php?admin/student/withdraw/'.$row['student_id'].'/'.$row['class_id'] , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>

                

                	

	

		<div class="form-group">

                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('photo');?></label>

                        

			<div class="col-sm-5">

                            <div class="fileinput fileinput-new" data-provides="fileinput">

				<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">

                                    <img src="<?php echo $this->crud_model->get_image_url('student' , $row['student_id']);?>" alt="...">

				</div>   

                            </div>

			</div>

		</div>

                <div class="form-group">

                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Name');?></label>

                        <div class="col-sm-5">

                            <input type="text" class="form-control" name="name" disabled

                                    value="<?php echo $this->db->get_where('student' , array('student_id' => $param2))->row()->name;?>"> 

			</div>

		</div>

                <div class="form-group">

                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('class');?></label>

                        <div class="col-sm-5">

                            <input type="text" class="form-control" name="class" disabled

                                    value="<?php echo $this->db->get_where('class' , array('class_id' => $row['class_id']))->row()->name; ?>">

			</div>

		</div>
<div class="form-group">

                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('enroll');?></label>

                        <div class="col-sm-5">

                            <input type="text" class="form-control" name="roll123" disabled value="<?php echo $row['roll']  ?>">
                            <input type="hidden" class="form-control" name="roll"  value="<?php echo $row['roll']  ?>">
			</div>

		</div>
                            <?php if($status == '0'):?>

                            <h3>This Student is already in withdraw List...</h3>

                            <?php else: ?>

		<div class="form-group">

                    <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Withdraw Date');?></label>

                        <div class="col-sm-5">

                            <input type="text" class="form-control datepicker" name="withdraw" value="" data-start-view="2">

			</div> 

		</div>

                <div class="form-group">

                    <label class="col-sm-3 control-label"><?php echo get_phrase('Reason');?></label>

                        <div class="col-sm-5">

                            <input type="text" class="form-control" name="description" />

                        </div>

                </div>

                <div class="form-group">

                    <label class="col-sm-3 control-label"><?php echo get_phrase('Prepared By');?></label>

                        <div class="col-sm-5">

                            <input type="text" class="form-control" name="prepared_by" />

                        </div>

                </div>

                 <div class="form-group">

                    <label class="col-sm-3 control-label"><?php echo get_phrase('Checked By');?></label>

                        <div class="col-sm-5">

                            <input type="text" class="form-control" name="check_by" />

                        </div>

                </div>

                 <div class="form-group">

                    <label class="col-sm-3 control-label"><?php echo get_phrase('Remarks');?></label>

                        <div class="col-sm-5">

                            <input type="text" class="form-control" name="remark"/>

                        </div>

                </div>

                 <div class="form-group">

                    <label class="col-sm-3 control-label"><?php echo get_phrase('Dues');?></label>

                        <div class="col-sm-5">

                            <input type="text" class="form-control" name="dues"/>

                        </div>

                </div>           



                    

                <div class="form-group">

                    <div class="col-sm-offset-3 col-sm-5">

			<button type="submit" class="btn btn-info"><?php echo get_phrase('Withdraw_student');?></button>

                    </div>

                </div>

                  <?php endif;?>          

                <?php echo form_close();?>

            </div>

        </div>

    </div>

</div>



<?php

endforeach;

?>



