
                   <?php
                    $page_data = $this->db->get('phone_directory',array('phone_directory_id'=>$param2))->result_array();
                    foreach ($page_data as $row):
                    ?>
               <div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('edit_phone_directory');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?admin/general_sms_directory/do_update/'.$row['phone_directory_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="name" value="<?php echo $row['name'];?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('phone');?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="phone" value="<?php echo $row['phone'];?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('address');?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="address" value="<?php echo $row['address'];?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('relation');?></label>
                                <div class="col-sm-5">
                                    <select name="relation" class="form-control" style="width:100%;">
                                        <option value="friend">friend</option>
                                    	<option value="teacher">teacher</option>
                                        <option value="ex-teacher">ex-teacher</option>
                                    	<option value="ex-student">ex-student</option>
                                        <option value="relative">relative</option>
                                    	
                                    </select>
                                </div>
                    </div>
                            
                     <?php endforeach;?>
            		<div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
				<button type="submit" class="btn btn-info"><?php echo get_phrase('edit_class');?></button>
                            </div>
			</div>
        		
            </div>
        </div>
    </div>
</div>
 	