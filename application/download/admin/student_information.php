<style>
    @media print {
        .visible-print  { display: inherit !important; }
        .hidden-print   { display: none !important; }
    }

    .visible-desktop { display: inherit !important; }
    .hidden-desktop   { display: none !important; }
</style>
<hr />

<a href="<?php echo base_url(); ?>index.php?admin/student_add" class="btn btn-primary pull-right">     
    <i class="entypo-plus-circled"></i> <?php echo get_phrase('add_new_student'); ?> 
</a> <br><div class="row">       <div class="col-md-12">                        
        <ul class="nav nav-tabs bordered">             
            <li class="active">                        
                <a href="#home" data-toggle="tab">     
                    <span class="visible-xs"><i class="entypo-users"></i></span> 
                    <span class="hidden-xs"><?php echo get_phrase('all_students'); ?></span> 
                </a>                       
            </li>  
            <?php
            $query = $this->db->get_where('section', array('class_id' => $class_id));
            if ($query->num_rows() > 0): $sections = $query->result_array();
                foreach ($sections as $row):
                    ?>    
                    <li>    
                        <a href="#<?php echo $row['section_id']; ?>" data-toggle="tab"> 
                            <span class="visible-xs"><i class="entypo-user"></i></span> 
                            <span class="hidden-xs"><?php echo get_phrase('section'); ?> <?php echo $row['name']; ?> ( <?php echo $row['nick_name']; ?> )</span>   
                        </a>  
                    </li>  
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>  
        
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
                        $students = $this->db->get_where('enroll', array('class_id' => $class_id, 'year' => $running_year, 'status' => 1))->result_array();
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
                                    echo date("d-M-Y" ,strtotime($this->db->get_where('student', array('student_id' => $row['student_id']))->row()->birthday));
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
                                            <!-- STUDENT MARKSHEET LINK  -->      
                                            <li>   
                                                <a href="<?php echo base_url(); ?>index.php?admin/student_marksheet/<?php echo $row['student_id']; ?>">     
                                                    <i class="entypo-chart-bar"></i>      
                                                    <?php echo get_phrase('mark_sheet'); ?>    
                                                </a>        
                                            </li>   
                                            <!-- STUDENT PROFILE LINK -->    
                                            <li>  
                                                <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modal_student_profile/<?php echo $row['student_id']; ?>');">       
                                                    <i class="entypo-user"></i>     
                                                    <?php echo get_phrase('profile'); ?>   
                                                </a>  
                                            </li>   
                                            <!-- STUDENT EDITING LINK -->    
                                            <li>     
                                                <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modal_student_edit/<?php echo $row['student_id']; ?>');">          
                                                    <i class="entypo-pencil"></i>    
                                                    <?php echo get_phrase('edit'); ?>   
                                                </a>  
                                            </li>     
                                            <li class="divider"></li>       
                                            <li>    
                                                <a href="<?php echo base_url(); ?>index.php?admin/student/certificate/<?php echo $row['student_id']; ?>">     
                                                    <i class="entypo-chart-bar"></i> 
                                                    <?php echo get_phrase('Admission Certificate'); ?>  
                                                </a>     
                                            </li>    
                                            <li class="divider"></li>    
                                            <!-- STUDENT DELETION LINK -->     
                                            <li>  
                                                <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>index.php?admin/student/<?php echo $class_id; ?>/delete/<?php echo $row['student_id']; ?>');">   
                                                    <i class="entypo-trash"></i>     
                                                    <?php echo get_phrase('delete'); ?>        
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
            <?php
            $query = $this->db->get_where('section', array('class_id' => $class_id)
            );
            if ($query->num_rows() > 0):
                $sections = $query->result_array();
                foreach ($sections as $row):
                    ?>     
                    <div class="tab-pane" id="<?php echo $row['section_id']; ?>">  

                        <table class="table table-bordered datatable" id="table_export">       
                            <thead>  
                                <tr>     
                                    <th width="80"><div><?php echo get_phrase('roll'); ?>          
                            </div>                            </th>                           
                            <th width="80"><div><?php echo get_phrase('photo'); ?></div></th>  
                            <th><div><?php echo get_phrase('name'); ?></div></th>              
                            <th class="span3"><div><?php echo get_phrase('address'); ?></div></th> 
                            <th><div><?php echo get_phrase('email'); ?></div></th>                 
                            <th><div><?php echo get_phrase('options'); ?></div></th>              
                            </tr>                                     
                            </thead>                  
                            <tbody>                      
                                <?php
                                $students = $this->db->get_where('enroll', array('class_id' => $class_id,
                                            'section_id' => $row['section_id'], 'year' => $running_year, 'status' => 1))->result_array();
                                foreach ($students as $row):
                                    ?>                          
                                    <tr>        
                                        <td><?php echo $row['roll']; ?></td>   
                                        <td><img src="<?php echo $this->crud_model->get_image_url('student', $row['student_id']); ?>" class="img-circle" width="30" /></td>        
                                        <td>      
                                            <?php
                                            echo $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->name;
                                            ?>                                 
                                        </td>                            
                                        <td>                             
                                            <?php echo $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->address;
                                            ?>
                                        </td>  
                                        <td>      
                                            <?php echo $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->email;
                                            ?>                           
                                        </td>                      
                                        <td>                       
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">   
                                                    Action <span class="caret"></span>   
                                                </button>                                
                                                <ul class="dropdown-menu dropdown-default pull-right" role="menu">   
                                                    <!-- STUDENT MARKSHEET LINK  -->                        
                                                    <li>                                               
                                                        <a href="<?php echo base_url(); ?>index.php?admin/student_marksheet/<?php echo $row['student_id']; ?>"> 
                                                            <i class="entypo-chart-bar"></i>                            
                                                            <?php echo get_phrase('mark_sheet'); ?>                                         
                                                        </a>                                             
                                                    </li>                                         
                                                    <!-- STUDENT PROFILE LINK -->                  
                                                    <li>                                         
                                                        <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modal_student_profile/<?php echo $row['student_id']; ?>');">                                          
                                                            <i class="entypo-user"></i>                                         
                                                            <?php echo get_phrase('profile'); ?>     
                                                        </a>    
                                                    </li>     
                                                    <!-- STUDENT EDITING LINK -->        
                                                    <li>                                 
                                                        <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modal_student_edit/<?php echo $row['student_id']; ?>');">        
                                                            <i class="entypo-pencil"></i>  
                                                            <?php echo get_phrase('edit'); ?>    
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
                <?php endforeach; ?>       
            <?php endif; ?>      
        </div>  
        
    </div>
</div>
<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->    

<script type="text/javascript">	jQuery(document).ready(function ($)

    {
        var datatable = $("#table_export").dataTable({
            "sPaginationType": "bootstrap",
            "sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>",
            "oTableTools": {
                "aButtons": [
                    {
                        "sExtends": "xls",
                        "mColumns": [0, 1, 3, 4, 6, 7, 8, 9]
                    },
                    {
                        "sExtends": "pdf",
                        "mColumns": [0, 1, 3, 4, 6, 7, 8, 9]
                    },
                    {
                        "sExtends": "print",
                        "fnSetText": "Press 'esc' to return",
                        "fnClick": function (nButton, oConfig) {
                            datatable.fnSetColumnVis(2, false);
                            datatable.fnSetColumnVis(5, false);
                            datatable.fnSetColumnVis(11, false);
                            this.fnPrint(true, oConfig);
                            window.print();
                            $(window).keyup(function (e) {
                                if (e.which == 27) {
                                    datatable.fnSetColumnVis(0, true);
                                    
                                    datatable.fnSetColumnVis(10, true);
                                }
                            });
                        },
                    },
                ]},
        });
        $(".dataTables_wrapper select").select2({
            minimumResultsForSearch: -1
        });
    });
</script>