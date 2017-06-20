<?php
if (
        $page_name == 'student_add'         ||
        $page_name == 'student_bulk_add'    ||
        $page_name == 'student_information' ||
        $page_name == 'student_marksheet'   ||
        $page_name == 'student_promotion'   ||
        $page_name == 'student_excel_add'
        ) 
    {
    ?>

    <ul class="nav tabs-vertical right-aligned" style="width: 100%">
        <!-- available classes "right-aligned" --> 
         <!-- STUDENT INFORMATION -->
        <li class= "<?php if ($page_name == 'student_information' || $page_name == 'student_marksheet') echo ' active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/student_information/">
                <span><i class="entypo-dot"></i> <?php echo get_phrase('student_information'); ?></span>
            </a>
        </li>
        <li class="<?php if ($page_name == 'student_add') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/student_add">
                <span><i class="entypo-dot"></i> <?php echo get_phrase('admit_student'); ?></span>
            </a>
        </li>
        <!-- STUDENT EXCEL ADMISSION -->
        <li class="<?php if ($page_name == 'student_excel_add') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/student_excel_add">
                <span><i class="entypo-dot"></i> <?php echo get_phrase('admit_excel_student'); ?></span>
            </a>
        </li>

        <!-- STUDENT BULK ADMISSION -->
        <li class="<?php if ($page_name == 'student_bulk_add') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/student_bulk_add">
                <span><i class="entypo-dot"></i> <?php echo get_phrase('admit_bulk_student'); ?></span>
            </a>
        </li>

       

        <!-- STUDENT PROMOTION -->
        <li class="<?php if ($page_name == 'student_promotion') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/student_promotion">
                <span><i class="entypo-dot"></i> <?php echo get_phrase('student_promotion'); ?></span>
            </a>
        </li>
    </ul>

    <?php
}
?>