<hr />
<a href="javascript:;" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modal_time_table_add/');" 
   class="btn btn-primary pull-right">
    <i class="entypo-plus-circled"></i>
    <?php echo get_phrase('add time table'); ?>
</a> 
<br><br><br>
<?php echo form_open(base_url() . 'index.php?admin/time_table/', array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top')); ?>
<div class="row">
    <div class="col-sm-3 ">
        <div class="form-group">
            <label for="field-2" class="col-sm-3 "><?php echo get_phrase('class'); ?></label>
            <div class="col-sm-8">
                <select name="class" class="form-control " onchange="return get_class_sections(this.value)" id="class_id">
                    <option value=""><?php echo get_phrase('class'); ?></option>
                    <?php
                    $classes = $this->db->get('class')->result_array();
                    foreach ($classes as $row):
                        ?>
                        <option value="<?php echo $row['class_id']; ?>">
                            <?php echo $row['name']; ?>
                        </option>
                        <?php
                    endforeach;
                    ?>
                </select>
            </div> 
        </div> 
    </div>

    <div class="col-sm-3 ">
        <div class="form-group">
            <label for="field-2" class="col-sm-3 "><?php echo get_phrase('section'); ?></label>
            <div class="col-sm-8">
                <select name="section_id" class="form-control" id="section_selector_holder">
                    <option value=""><?php echo get_phrase('select_class_first'); ?></option>
                </select>
            </div>
        </div> 
    </div>

    <div class="col-sm-3">
        <div class="form-group">
            <label for="field-2" class="col-sm-3 "><?php echo get_phrase('exam'); ?></label>
            <div class="col-sm-8">
                <select name="exam" class="form-control " onchange="form_submit()">
                    <option value=""><?php echo get_phrase('exam'); ?></option>
                    <?php
                    $exams = $this->db->get('exam')->result_array();
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
    <div class="form-group">
        <div class="col-sm-3">
            <button type="submit" class="btn btn-info"><?php echo get_phrase('View Time Table'); ?></button>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-sm-12">
        <?php
        
        if ($class_id != '' && $section_id != '' && $exam_id != '') {
            
             $this->load->view('backend/admin/time_table_view', array('class_id' => $class_id,
                'section_id' => $section_id,
                'exam_id' => $exam_id,));
        }
        ?> 
    </div>

</div>


<script type="text/javascript">

    function get_class_sections(class_id) {

        $.ajax({
            url: '<?php echo base_url(); ?>index.php?admin/get_class_section/' + class_id,
            success: function (response)
            {
                jQuery('#section_selector_holder').html(response);
            }
        });

    }

</script>

