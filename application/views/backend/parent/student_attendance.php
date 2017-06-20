<?php
 $conn=mysql_connect('localhost','itkoor_engrasad','Di wi kakad 15702');

 // Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

 $select=mysql_select_db('itkoor_school');

  


$parent_id = $this->session->userdata('parent_id');


//$query2="select * from student";
//$run2=mysql_query($query2);
//while($row = mysql_fetch_array($run2)){  
//echo  $row['name'] . "   " . $row['sex'] . "   ".$row['address']."<br>";  
//}
	$data['description'] = $this->input->post('running_year');
       
	 $running_year = $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;
//echo $running_year;			
$query1="SELECT S.name StudentName,C.name className,S1.name SectionName,A.timestamp Timestamp,A.status  FROM student S 
           JOIN enroll E ON E.student_id=S.student_id 
           JOIN class C ON E.class_id=C.class_id
           JOIN section S1 ON E.section_id=S1.section_id
           JOIN attendance A ON (A.class_id=E.class_id AND A.section_id=E.section_id)
           join parent P on S.parent_id=P.parent_id where P.parent_id=$parent_id  order by A.timestamp desc";
 $run = mysql_query($query1);

$count=0;
while($row=mysql_fetch_array($run)){
    $s_name[$count]=$row[0];
     $c_name[$count]=$row[1];
     $st_name[$count]=$row[2];
    $s_date[$count]=$row[3];
     $s_status[$count]=$row[4];
    $date=$s_date[$count];

    switch($s_status[$count]){
        case 0:
            $s_status[$count]="Undefine";
            break;
        case 1:
        $s_status[$count]="present";
            break;
        case 2:
            $s_status[$count]="Absent";
            break;
    }

  
      $time1 = strtotime($s_date[$count]);
      $timeday[$count]= date('d', $time1);
      $timemonth[$count]= date('m', $time1);
 
     $count++;
}

?>

<div class="container">
    
    <!-- <div class="row">
        <div class="col-lg-3 col-lg-offset-7 col-sm-4 col-sm-offset-8 col-xs-4 col-xs-offset-8">
            <input type="search" id="search" value="" class="form-control" placeholder="Search Student Attendance">
        </div>
    </div> -->
    <div class="row">
        <div class="col-lg-10">
            <table class="table table-bordered datatable" id="table_export">
                <thead>
                    <tr>
                       <th>#</th>
                            <th><?php echo get_phrase('Student Name');?></th>
                            <th><?php echo get_phrase('Class');?></th>
                            <th><?php echo get_phrase('Section');?></th>
                            <th><?php echo get_phrase('Day');?></th>
                            <th><?php echo get_phrase('Month');?></th>
                            <th><?php echo get_phrase('Attendance');?></th>
                            <th><?php echo get_phrase('Date');?></th>

                    </tr>
                </thead>
                <tbody>
				 <?php 
                               // $classes	=	$this->db->get('class' )->result_array();
                               // foreach($classes as $row):?>
								
				<?php 		//	$sections	=	$this->db->get('section' )->result_array();
                               // foreach($sections as $row1):?>
								
                <?php    $number=1;       for($count1=0;$count1<$count;$count1++){ ?>
                    <tr>
                        <th><?php echo $number++;?></th>
                        <td><?php echo $s_name[$count1];?></td>
                        <td><?php echo $c_name[$count1];?></td>
                        <td><?php echo $st_name[$count1];?></td>
                        <td><?php echo $timeday[$count1];?></td>
                        <td><?php echo $timemonth[$count1];?></td>
                        <td><?php echo $s_status[$count1];?></td>
                       <!-- <td><?php// echo $s_date[$count1];?></td>-->
                        <td><?php echo date('d M,Y', $s_date[$count1]);?></td>

                    </tr>
					
                    <?php   }  ?>
					<?php// endforeach;?>
					<?php// endforeach;?>
					
                  
                </tbody>
            </table>
            <hr>
        </div>
    </div>
    
    
</div>

<script src="//rawgithub.com/stidges/jquery-searchable/master/dist/jquery.searchable-1.0.0.min.js"></script>


