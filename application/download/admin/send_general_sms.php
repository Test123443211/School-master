<hr>
<?php echo form_open(base_url() . 'index.php?admin/sending_general_sms', array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top')); ?>
<div class="row">
    <div class="col-sm-6">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('Send SMS'); ?></label>
                    <div class="col-sm-9">
                        <select name="relation" class="form-control" style="width:100%;" id="messageType">
                            <option value="">Select Type</option>
                            <option value="class_wise">Class Wise</option>
                            <option value="all_teacher">All Teachers</option>
                            <option value="specific_teacher">Specific Teachers</option>
                            <option value="all_student">All Student</option>
                            <option value="specific_student">Specific student</option>
                            <option value="all_directory">All Phone Directory</option>
                            <option value="specific_directory">Specific Phone Directory</option>

                        </select>
                        <br/>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('message'); ?></label>
                    <div class="col-sm-9">
                        <!--<textarea class="form-control" rows="6" name="general_message"></textarea>-->
                        <textarea id="textareaChars" maxlength="150" class="form-control" rows="6" name="general_message"></textarea>

                        <span id="chars">150</span> characters remaining
                    </div>
                </div>
            </div>
        </div>


    </div>

    <div class="col-xs-3 col-sm-3">
        <div class="row" id="result">

            <div id="class_wise_message" style="display: none">
                <?php
                $classes = $this->db->get('class')->result_array();
                foreach ($classes as $row):
                    ?>

                    <div class="checkbox">
                        <label>
                            <input name="class_wise[]" class="class_check" type="checkbox" value="<?php echo $row['class_id'] ?>">   <?php echo $row['name']; ?>
                        </label>
                    </div>

                    <?php
                endforeach;
                ?>
                <div>
                    <button type="button" class="btn btn-default" onClick="select2()"><?php echo get_phrase('select_all') ?></button>
                    <button type="button" class="btn btn-default" onClick="unselect2()"><?php echo get_phrase('unselect_all') ?></button>

                </div>
            </div>
            <!--Class List-->
            <div class="form-group" id="class_list" style="display: none">
                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('class'); ?></label>

                <div class="col-sm-9">
                    <select name="class_id" class="form-control selectboxit"
                            onchange="return get_class_students(this.value)">
                        <option value=""><?php echo get_phrase('select_class'); ?></option>
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
    </div>

    <!--Student List-->
    <div id="student_list" class="col-xs-3 col-sm-3">

    </div>

    <!--Teacher List-->
    <div id="teacher_list" class="col-xs-3 col-sm-3" style="display: none;">
        <?php
        $teachers = $this->db->get('teacher')->result_array();
        foreach ($teachers as $row):
            ?>

            <div class="checkbox">
                <label>
                    <input name="specific_teacher[]" type="checkbox" value="<?php echo $row['teacher_id'] ?>">   <?php echo $row['name']; ?>
                </label>
            </div>
            <?php
        endforeach;
        ?>
    </div>

    <!--General phone Libraray List-->
    <div id="general_list" class="col-xs-3 col-sm-3" style="display: none;">
        <?php
        $general_list = $this->db->get('phone_directory')->result_array();
        foreach ($general_list as $row):
            ?>

            <div class="checkbox">
                <label>
                    <input name="general_list[]" type="checkbox" value="<?php $row['phone_directory_id'] ?>">   <?php echo $row['name']; ?>
                </label>
            </div>
            <?php
        endforeach;
        ?>
    </div>


</div>
<div class="form-group">
    <div class="col-sm-6 col-sm-offset-3">
        <button type="submit" class="btn btn-info"><?php echo get_phrase('Send SMS'); ?></button>
    </div>
</div>
<?php echo form_close(); ?>
<script type="text/javascript">

var maxLength = 150;
$('#textareaChars').keyup(function() {
  var length = $(this).val().length;
  var length = maxLength-length;
  $('#chars').text(length);
});


    $(function () {

        $("#messageType").on("change", function () {
            var messageType = $(this).val();

            $("#teacher_list").hide();
            $("#general_list").hide();
            $("#class_list").hide();
            $("#class_wise_message").hide();

            jQuery('#student_list').html('');
            if (messageType == 'class_wise') {
                $("#class_wise_message").show();
            } else if (messageType == 'specific_student') {
                $("#class_list").show();
            } else if (messageType == 'specific_teacher') {
                $("#teacher_list").show();
            } else if (messageType == 'specific_directory') {
                $("#general_list").show();
            }

        });
    });

    function select2() {
        var chk = $('.class_check');
        for (i = 0; i < chk.length; i++) {
            chk[i].checked = true;
        }
    }
    function unselect2() {
        var chk = $('.class_check');
        for (i = 0; i < chk.length; i++) {
            chk[i].checked = false;
        }
    }

    function get_class_students(class_id) {
        $.ajax({
            url: '<?php echo base_url(); ?>index.php?admin/get_class_students_mass/' + class_id,
            success: function (response)
            {
                jQuery('#student_list').html(response);
            }
        });
    }

    function select() {
        var chk = $('.check');
        for (i = 0; i < chk.length; i++) {
            chk[i].checked = true;
        }

        //alert('asasas');
    }
    function unselect() {
        var chk = $('.check');
        for (i = 0; i < chk.length; i++) {
            chk[i].checked = false;
        }
    }
</script>