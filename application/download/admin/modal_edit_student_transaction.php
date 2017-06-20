<?php
$id = $param2;
$query = $this->db->get_where('student_transaction', array(
    'id' => $param2
        ));
;
?>

<div class="tab-pane box" id="addclasswise">


    <div class="box-content">
        <?php echo form_open(base_url() . 'index.php?admin/student_transaction/update/'.$id, array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top')); ?>
        <div class="padded">



            <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label">Payment</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="payment" value="<?php echo $query->row()->payment ?>" >
                </div> 
            </div>

            <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label">Due Date</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control datepicker" name="due_date" data-format="dd-mm-yyyy"  value="<?php echo date("d-m-Y", strtotime($query->row()->due_date)) ?>"/>
                </div> 
            </div>

            <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('checked_by'); ?></label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="checked_by" value="<?php echo $query->row()->checked_by ?>" >
                </div> 
            </div>

            <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('created_by'); ?></label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="created_by" value="<?php echo $query->row()->created_by ?>" >
                </div> 
            </div>

            <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('remarks'); ?></label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="remarks" value="<?php echo $query->row()->remarks?>" >
                </div> 
            </div>

        </div>
        <div class="form-group">
            <div class="col-sm-offset-4 col-sm-4">
                <button type="submit" class="btn btn-info"><?php echo get_phrase('edit_transaction'); ?></button>
            </div>
        </div>
        </form>                
    </div>
</div>