<hr />
<?php echo form_open(base_url() . 'index.php?admin/attendance_report_selector/'); ?>



<div class="row">    <?php
    $query = $this->db->get('class');
    if ($query->num_rows() > 0): $class = $query->result_array();
        ?>       

        <div class="col-md-3">            <div class="form-group">           
                <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('class'); ?></label> 
                <select class="form-control selectboxit" name="class_id" onchange="select_section(this.value)"> 
                    <option value=""><?php echo get_phrase('select_class'); ?></option>                  
                    <?php foreach ($class as $row): ?>                        <option value="<?php echo $row['class_id']; ?>"<?php if ($class_id == $row['class_id']) echo 'selected'; ?> ><?php echo $row['name']; ?></option>                    <?php endforeach; ?>                </select>            </div>        </div>    <?php endif; ?>    <?php
    $query = $this->db->get_where('section', array('class_id' => $class_id));
    if ($query->num_rows() > 0): $sections = $query->result_array();
        ?>      

        <div id="section_holder">           
            <div class="col-md-3">              
                <div class="form-group">            
                    <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('section'); ?></label>    
                    <select class="form-control selectboxit" name="section_id">       
                        <?php foreach ($sections as $row): ?>                        
                            <option value="<?php echo $row['section_id']; ?>"            
                                    <?php if ($section_id == $row['section_id']) echo 'selected'; ?>><?php echo $row['name']; ?></option>   
                                <?php endforeach; ?>           
                    </select>        
                </div>          
            </div>      
        </div>  
    <?php endif; ?>   
    <div class="col-md-3">   
        <div class="form-group">         
            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('section'); ?></label>    
            <select name="month" class="form-control selectboxit" id="month">     
                <?php
                for ($i = 1; $i <= 12; $i++): if ($i == 1)
                        $m = 'January';
                    else if ($i == 2)
                        $m = 'February';

                    else if ($i == 3)
                        $m = 'March';
                    else if ($i == 4)
                        $m = 'April';
                    else if ($i == 5)
                        $m = 'May';
                    else if ($i == 6)
                        $m = 'June';
                    else if ($i == 7)
                        $m = 'July';
                    else if ($i == 8)
                        $m = 'August';
                    else if ($i == 9)
                        $m = 'September';
                    else if ($i == 10)
                        $m = 'October';
                    else if ($i == 11)
                        $m = 'November';
                    else if ($i == 12)
                        $m = 'December';
                    ?>                
                    <option value="<?php echo $i; ?>"                       
                            <?php if ($month == $i) echo 'selected'; ?>  >                 
                                <?php echo ucfirst($m); ?>                 
                    </option>            
                <?php endfor; ?>     
            </select>     
        </div> 
    </div>  
    <input type="hidden" name="year" value="<?php echo $running_year; ?>">  
    <div class="col-md-3" style="margin-top: 20px;">      
        <button type="submit" class="btn btn-info">
            <?php echo get_phrase('show_report'); ?></button>  
    </div>
</div>

<?php if ($class_id != '' && $section_id != '' && $month != ''): ?>  
    <br>  
    <div class="row">   
        <div class="col-md-4"></div>       
        <div class="col-md-4" style="text-align: center;">   
            <div class="tile-stats tile-gray">    
                <div class="icon"><i class="entypo-docs"></i></div>       
                <h3 style="color: #696969;">            
                    <?php
                    $section_name = $this->db->get_where('section', array('section_id' => $section_id))->row()->name;

                    $class_name = $this->db->get_where('class', array('class_id' => $class_id))->row()->name;
                    if ($month == 1)
                        $m = 'January';
                    else if ($month == 2)
                        $m = 'February';
                    else if ($month == 3)
                        $m = 'March';
                    else if ($month == 4)
                        $m = 'April';
                    else if ($month == 5)
                        $m = 'May';
                    else if ($month == 6)
                        $m = 'June';
                    else if ($month == 7)
                        $m = 'July';
                    else if ($month == 8)
                        $m = 'August';
                    else if ($month == 9)
                        $m = 'Sepetember';
                    else if ($month == 10)
                        $m = 'October';
                    else if ($month == 11)
                        $m = 'November';
                    else if ($month == 12)
                        $m = 'December';
                    echo get_phrase('attendance_sheet');
                    ?>                </h3>               
                <h4 style="color: #696969;">            
                    <?php echo get_phrase('class') . ' ' . $class_name; ?> : <?php echo get_phrase('section'); ?> <?php echo $section_name; ?><br>                   
                    <?php echo $m; ?>             
                </h4>        
            </div>      
        </div>       
        <div class="col-md-4"></div>  
    </div>   
    <hr />   


    <div class="row">   
        <div class="col-md-12">  
            <table class="table table-bordered" id="my_table">       
                <thead>               
                    <tr>              
                        <td style="text-align: center;" rowspan="2">         
                            <?php echo get_phrase('students'); ?>  
                            <i class="entypo-down-thin"></i>  
                            | <?php echo get_phrase('date'); ?>   
                            <i class="entypo-right-thin"></i>   
                        </td> 
                    </tr> 
                    <tr> 
                        <?php
                        $year = explode('-', $running_year);
                        $holidays = array();

                        $holidaysvalue = $this->db->get_where('holidays', array(
                                    'YEAR( from_date ) = ' => $year[0],
                                    'MONTH( from_date ) = ' => $month
                                ))->result_array();


                        foreach ($holidaysvalue as $value) {
                            $from_date = $value['from_date'];
                            $to_date = $value['to_date'];
                            if (strtotime($from_date) == strtotime($to_date)) {
                                $date = date("j", strtotime($from_date));

                                $start = $date;
                                $holidays[$start] = $value['title'];
                            } else {
                                $date = date("j", strtotime($from_date));
                                $diff = abs(strtotime($from_date) - strtotime($to_date));
                                $years = floor($diff / (365 * 60 * 60 * 24));
                                $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                                $dayss = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
//                                $totaldays = $dayss + 1;
                                $total_days = (int) $date + (int) $dayss;
//                                echo "Total days" + $totaldays. " to date". (  (int)$date + (int)$dayss);
                                for ($start = $date; $start <= $total_days; $start++) {
                                    $holidays[$start] = $value['title'];
                                }
                            }
                        }


                        $days = cal_days_in_month(CAL_GREGORIAN, $month, $year[0]);
                        for ($i = 1; $i <= $days; $i++) {
                            $date = $year[0] . '/' . $month . '/' . $i; //format date
                            $get_name = date('l', strtotime($date)); //get week day
                            $day_name = substr($get_name, 0, 3); // Trim day name to 3 chars
                            //if not a weekend add day to array
                            if ($day_name != 'Sun') {
                                ?>
                                <td colspan="2" style="text-align: center;">
                                    <table>
                                        <tr>
                                            <td colspan="2">  <?php echo $i; ?> </td>
                                        </tr>
                                        <tr style="font-size: 8px">
                                            <td style="border-right: 1px double grey;"> 1st <br/> mfg </td>
                                            <td> 2nd<br/> mfg </td>
                                        </tr>
                                    </table>


                                </td>
                                <?php
                            } else {
                                ?>
                                <td colspan="2" style="text-align: center;">
                                    <?php echo $i; ?>
                                </td>

                                <?php
                            }
                        }
                        ?> 
                        <td>Prev Attd</td>
                        <td>Curr Attd</td>
                        <td>Total Attd</td>
                        <td>Remarks</td>
                    </tr>       
                </thead>     
                <tbody style="font-size: 10px;">   
                    <?php
                    $data = array();
                    $firstrow = 0;
                    $totalattend = 0;


                    $students = $this->db->get_where('enroll', array('class_id' => $class_id, 'year' => $running_year, 'section_id' => $section_id, 'status' => 1))->result_array();
                    $countstudent = count($students);


                    foreach ($students as $row):
                        ?>                      
                        <tr>                          
                            <td style="text-align: center;">    
                                <?php
                                echo $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->name;
                                ?> 
                            </td>                     
                            <?php
                            //SELECT *  FROM holidays WHERE YEAR( from_date ) =2016 AND MONTH( from_date ) =9 



                            $status_first = 0;
                            $status_last = 0;
                            $firstrow++;
                            for ($i = 1; $i <= $days; $i++) {

                                $date = $year[0] . '/' . $month . '/' . $i; //format date
                                $get_name = date('l', strtotime($date)); //get week day
                                $day_name = substr($get_name, 0, 3); // Trim day name to 3 chars

                                $timestamp = strtotime($i . '-' . $month . '-' . $year[0]);

                                if ($day_name == 'Sun') {
                                    if ($firstrow == 1) {
                                        ?>
                                        <td colspan="2" class="weekendtr" rowspan="<?php echo $countstudent ?>" style="vertical-align: middle">
                                            <?php
                                            $print_count = floor($countstudent / 7);
                                            for ($j = 0; $j <= $print_count; $j++) {
                                                ?>
                                                <i class="entypo-star-empty"></i><br/> 
                                                <br/>S<br/> <br/>U<br/> <br/>N<br/><br/> D<br/><br/> A<br/><br/> Y<br/><br/> 
                                                <i class="entypo-star-empty"></i> <br/><br/><br/><br/>
                                                <?php
                                            }
                                            ?>
                                        </td>


                                        <?php
                                    }
                                    continue;
                                }
                                if (array_key_exists($i, $holidays)) {
                                    if ($firstrow == 1) {
                                        ?>
                                        <td colspan="2" class="holidaytr" rowspan="<?php echo $countstudent ?>" style="vertical-align: middle; text-align: center">
                                            <?php
                                            $holiday_title = str_split($holidays[$i]);
                                            $stringLength = strlen($holidays[$i]);
                                            $print_count = floor($countstudent / $stringLength);
                                            ?>
                                            <i class="entypo-star-empty"></i><br/> 
                                            <?php
                                            foreach ($holiday_title as $char) {
                                                echo $char . "<br/>";
                                            }
                                            ?>
                                            <i class="entypo-star-empty"></i> 
                                            <br/><br/><br/><br/>

                                        </td>


                                        <?php
                                    }
                                    continue;
                                }


                                $this->db->group_by('timestamp');
                                $student_id = $row['student_id'];
                                $attendance = $this->db->get_where('attendance', array(
                                            'section_id' => $section_id,
                                            'class_id' => $class_id,
                                            'year' => $running_year,
                                            'timestamp' => $timestamp,
                                            'student_id' => $student_id))->result_array();


                                if (count($attendance) > 0) {
                                    foreach ($attendance as $row1): $month_dummy = date('n', $row1['timestamp']);
                                        if ($i == $month_dummy)
                                            ;
                                        $status_first = $row1['status_first'] !== 0 ? $row1['status_first'] : 0;
                                        if ($i == $month_dummy)
                                            ;
                                        $status_last = $row1['status_last'] !== 0 ? $row1['status_last'] : 0;
                                    endforeach;

                                    if ($status_first == 2) {
                                        $backgroudcolor = " #ee4749";
                                    } elseif ($status_first == 3 || $status_first == 4) {
                                        $backgroudcolor = " #006699";
                                    } else {
                                        $backgroudcolor = " white";
                                    }
                                    
                                    if ($status_last == 2) {
                                        $backgroudcolor2 = " #ee4749";
                                    } elseif ($status_last == 3 || $status_last == 4) {
                                        $backgroudcolor2 = " #006699";
                                    } else {
                                        $backgroudcolor2 = " white";
                                    }
                                    
                                    
                                    ?>                                  
                                    <td style="background-color:  <?php echo $backgroudcolor; ?>  ">                                     
                                        <?php  
                                        if ($status_first == 1){?>
                                            <span style="color: #000000;">  P </span>
                                      <?php  }
                                        elseif ($status_first == 2) { ?>                                                                                                                                           

                                            <span style="color: #ffffcc;">A</span>   

                                        <?php } else if ($status_first == 3) {
                                            ?>                                                                                                                                           

                                            <span style="color: #ffff00;">S</span>   

                                        <?php } else if ($status_first == 4) {
                                            ?>                                                                                                                                           

                                            <span style="color: #ffff00;">L</span>   

                                        <?php } ?>

                                    </td>                                   
                                    <td style="background-color:  <?php echo $backgroudcolor2; ?> ">                
                                            <?php 
                                            if ($status_last == 1){?>
                                            <span style="color: #000000;">  P </span>
                                      <?php
                                            
                                        }
                                            if ($status_last == 2) { ?> 
                                            <span style="color:#ffffcc;">A</span> 

                                        <?php } else if ($status_last == 3) {
                                            ?>                                                                                                                                           

                                            <span style="color: #ffff00;">S</span>   

                                        <?php } else if ($status_last == 4) {
                                            ?>                                                                                                                                           

                                            <span style="color: #ffff00;">L</span>   

                                        <?php } ?>                                  
                                    </td>                                   
                                <?php } else { ?>                                  
                                    <td style="">     
                                    </td>              
                                    <td style="">          
                                    </td>             
                                    <?php
                                }
                            }
                            ?>     
                            <td>
                                <?php
                                $prevattd = $this->db->get_where('attendance_count', array(
                                            'class_id' => $class_id,
                                            'student_id' => $student_id,
                                            'year' => $running_year,
                                            'month' => date("m", $timestamp) - 1,
                                        ))->row()->total_atd;

                                echo $prevattd;
                                ?></td>
                            <td> <?php
                                echo $curratted = $this->db->get_where('attendance_count', array(
                                    'class_id' => $class_id,
                                    'student_id' => $student_id,
                                    'year' => $running_year,
                                    'month' => date("m", $timestamp),
                                ))->row()->total_atd;
                                $totalattend += $curratted;
                                ?></td>
                            <td>
                                <?php
                                echo $curratted + $prevattd;
                                ?>
                            </td>
                            <td></td>
                        </tr>     

                    <?php endforeach; ?>   


                </tbody>        
            </table>  
            <center>
                Average attendances of the Month  =  <?php echo $totalattend . "/ " . $countstudent . " = " . round($totalattend / $countstudent, 2) ?>
            </center>
            <center>           
                <a href="<?php echo base_url(); ?>index.php?admin/attendance_report_print_view/<?php echo $class_id; ?>/<?php echo $section_id; ?>/<?php echo $month; ?>"                    class="btn btn-primary" target="_blank">                    <?php echo get_phrase('print_attendance_sheet'); ?>                </a>     
            </center>      
        </div>  
    </div>
<?php endif; ?>

<style>
    .weekendtr
    {

        /*background-image:url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' version='1.1' height='50px'><text x='0' y='15' fill='white' font-size='5'>SUNDAY</text></svg>");*/
        background-color: #ff9999 !important;
        color: #ffffcc; 
        vertical-align: middle;

        /*border-bottom: 1px solid #999999 !important;*/
    } 
    .holidaytr{
        background-color: #00cccc !important;
        color: #ffffcc; 
        vertical-align: middle;

    }
</style>
<script type="text/javascript">

    $(document).ready(function () {
        if ($.isFunction($.fn.selectBoxIt))
        {
            $("select.selectboxit").each(function (i, el)

            {
                var $this = $(el), opts = {showFirstOption: attrDefault($this, 'first-option', true), 'native': attrDefault($this, 'native', false), defaultText: attrDefault($this, 'text', ''), };
                $this.addClass('visible');
                $this.selectBoxIt(opts);
            });
        }
    });</script><script type="text/javascript">    function select_section(class_id) {
            $.ajax({url: '<?php echo base_url(); ?>index.php?admin/get_section/' + class_id, success: function (response) {
                    jQuery('#section_holder').html(response);
                }});
        }</script>