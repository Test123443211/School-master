<!----CREATION FORM STARTS---->
<div class="tab-pane box" id="add" style="padding: 5px">
    <div class="box-content">
        <?php echo form_open(base_url() . 'index.php?admin/time_table/create/', array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top')); ?>
        <div class="padded">
            <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo get_phrase('class'); ?></label>
                <div class="col-sm-5">
                    <select name="class" class="form-control" style="width:100%;" onchange="return get_class_sections(this.value)" id="class_id">
                        <option value=""><?php echo get_phrase('class'); ?></option>
                        <?php
                        $classes = $this->db->get('class')->result_array();
                        foreach ($classes as $row):
                            ?>
                            <option value="<?php echo $row['class_id']; ?>"><?php echo $row['name']; ?></option>
                            <?php
                        endforeach;
                        ?>
                    </select>
                </div>

            </div>

            <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('section'); ?></label>
                <div class="col-sm-5">
                    <select name="section_id" class="form-control" id="section_selector_holder12">
                        <option value=""><?php echo get_phrase('select_class_first'); ?></option>

                    </select>
                </div>
            </div>


            <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo get_phrase('exam'); ?></label>
                <div class="col-sm-5">
                    <select name="exam" class="form-control " style="width:100%;">
                        <option value=""><?php echo get_phrase('exam'); ?></option>
                        <?php
                        $exam = $this->db->get('exam')->result_array();
                        foreach ($exam as $row):
                            ?>
                            <option value="<?php echo $row['exam_id']; ?>"><?php echo $row['name']; ?></option>
                            <?php
                        endforeach;
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo get_phrase('first subject'); ?></label>
                <div class="col-sm-5">
                    <select name="subject_first" class="form-control " style="width:100%;">
                        <option value=""><?php echo get_phrase('subject'); ?></option>
                        <?php
                        $exam = $this->db->get('subject')->result_array();
                        foreach ($exam as $row):
                            ?>
                            <option value="<?php echo $row['subject_id']; ?>"><?php echo $row['name']; ?></option>
                            <?php
                        endforeach;
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo get_phrase('second subject'); ?></label>
                <div class="col-sm-5">
                    <select name="subject_second" class="form-control " style="width:100%;">
                        <option value=""><?php echo get_phrase('subject'); ?></option>
                        <?php
                        $exam = $this->db->get('subject')->result_array();
                        foreach ($exam as $row):
                            ?>
                            <option value="<?php echo $row['subject_id']; ?>"><?php echo $row['name']; ?></option>
                            <?php
                        endforeach;
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('date'); ?></label>
                <div class="col-sm-5">
                    <input type="text" class="form-control datepicker" name="date" value="" data-start-view="2">
                </div> 
            </div>

            <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('first time'); ?></label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="first_time" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" value="" autofocus>
                </div>
            </div>

            <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('second time'); ?></label>

                <div class="col-sm-5">
                    <input type="text" class="form-control" name="second_time" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" value="" autofocus>
                </div>
            </div>

        </div>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-5">
                <button type="submit" class="btn btn-info"><?php echo get_phrase('add_class'); ?></button>
            </div>
        </div>
        </form>                
    </div>                
</div>
<!----CREATION FORM ENDS-->
</div>
</div>
</div>
<script type="text/javascript">

    function get_class_sections(class_id) {

        $.ajax({
            url: '<?php echo base_url(); ?>index.php?admin/get_class_section/' + class_id,
            success: function (response)
            {
                $('#section_selector_holder12').html(response);
            }
        });

    }

</script>