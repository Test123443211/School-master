<hr />



<?php echo form_open(base_url() . 'index.php?admin/withdraw_student/'); ?>

<div class="row">



    <div class="col-sm-4 col-sm-offset-2">

        <div class="form-group">

            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('session'); ?></label>

            <select name="running_year" class="form-control selectboxit">

                <?php $running_year = $session != "" ? $session : $this->db->get_where('settings', array('type' => 'running_year'))->row()->description; ?>

                <option value=""><?php echo get_phrase('select_running_session'); ?></option>

                <?php for ($i = 0; $i < 20; $i++): ?>

                    <option value="<?php echo (2010 + $i); ?>-<?php echo (2010 + $i + 1); ?>"

                            <?php if ($running_year == (2010 + $i) . '-' . (2010 + $i + 1)) echo 'selected'; ?>>

                        <?php echo (2010 + $i); ?>-<?php echo (2010 + $i + 1); ?>

                    </option>

                <?php endfor; ?>

            </select>

        </div>

    </div>

    <div class="col-sm-4" style="margin-top: 20px;">

        <button type="submit" class="btn btn-info"><?php echo get_phrase('withdraw_student'); ?></button>

    </div>



</div>

<?php
echo form_close();

if ($session != ""):
    ?>


    <div class="tab-content">      
        <div class="tab-pane active" id="home">   
            <table class="table table-bordered datatable" id="table_export"> 
                <thead>       
                    <tr> 
                        <th witdth="80" class="hidden-desktop visible-print"><div><?php echo get_phrase('admission_date'); ?></div></th>  
                        <th width="80"><div><?php echo get_phrase('roll'); ?></div></th>   
                        <th width="80"><div><?php echo get_phrase('photo'); ?></div></th>   
                        <th><div><?php echo get_phrase('name'); ?></div></th>
                        <th><div><?php echo get_phrase('Parent'); ?></div></th>
                        <th><div><?php echo get_phrase('email'); ?></div></th>
                        <th><div><?php echo get_phrase('birthday'); ?></div></th>
                        <th class="hidden-desktop visible-print"><div><?php echo get_phrase('DOB_inwords'); ?></div></th>
                        <th class="span3"><div><?php echo get_phrase('address'); ?></div></th>
                        <th class="hidden-desktop visible-print"><div><?php echo get_phrase('Caste'); ?></div></th>
                        <th class="hidden-desktop visible-print"><div><?php echo get_phrase('Profession'); ?></div></th>
                        <th><div><?php echo get_phrase('options'); ?></div></th> 
                    </tr>   
                </thead>     
                <tbody>

                    <?php
                    $students = $this->db->get_where('enroll', array('year' => $session, 'status' => 0))->result_array();
                    foreach ($students as $row):
                        ?>
                        <?php
                        $parent_id = $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->parent_id;
                        ?>       
                        <tr>
                            <td class="hidden-desktop visible-print">   
                                <?php
                                echo $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->admission_date;
                                ?>     
                            </td>
                            <td><?php echo $row['roll']; ?></td>    
                            <td><img src="<?php echo $this->crud_model->get_image_url('student', $row['student_id']); ?>" class="img-circle" width="30" /></td>            
                            <td>   
                                <?php
                                echo $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->name;
                                ?>     
                            </td>
                            <td>   
                                <?php
                                echo $this->db->get_where('parent', array('parent_id' => $parent_id))->row()->name;
                                ?>     
                            </td>

                            <td>     
                                <?php
                                echo $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->email;
                                ?> 
                            </td>
                            <td>     
                                <?php
                                echo date("d-M-Y", strtotime($this->db->get_where('student', array('student_id' => $row['student_id']))->row()->birthday));
                                ?> 
                            </td>
                            <td class="hidden-desktop visible-print">     
                                <?php
                                echo $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->dob_in_words;
                                ?> 
                            </td>
                            <td>    
                                <?php
                                echo $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->address;
                                ?>    
                            </td>
                            <td class="hidden-desktop visible-print">    
                                <?php
                                echo $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->caste;
                                ?>    
                            </td>
                            <td class="hidden-desktop visible-print">   
                                <?php
                                echo $this->db->get_where('parent', array('parent_id' => $parent_id))->row()->profession;
                                ?>     
                            </td>
                            <td>    
                                <div class="btn-group">      
                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"> 
                                        Action <span class="caret"></span>    
                                    </button>     
                                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">     
                                        <li>  
                                            <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modal_student_profile/<?php echo $row['student_id']; ?>');">       
                                                <i class="entypo-user"></i>     
                                                <?php echo get_phrase('profile'); ?>   
                                            </a>  
                                        </li>   

                                        <li class="divider"></li>
                                        <!--STUDENT CERTIFICATE-->
                                        <li>    
                                            <a href="<?php echo base_url();?>index.php?admin/withdraw_certificate/<?php echo $row['student_id'];?>">     
                                                <i class="entypo-chart-bar"></i> 
                                                   <?php echo get_phrase('Withdraw Certificate');?>  
                                            </a>     
                                        </li>

                                        <!-- STUDENT WITHDRAW LINK -->     
                                        <li> 
                                            <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modal_withdraw_edit/<?php echo $row['student_id']; ?>');">                
                                                <i class="entypo-block"></i>     
                                                <?php echo get_phrase('Withdraw_student'); ?>  
                                            </a>    
                                        </li> 
                                    </ul>   
                                </div>   
                            </td>   
                        </tr>      
                    <?php endforeach; ?> 
                </tbody>      
            </table>
        </div>        

    </div>  

    <?php
endif;
?>