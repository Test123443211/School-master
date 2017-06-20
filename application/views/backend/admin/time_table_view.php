  

<center>
    <a onClick="PrintElem('#Timetable')" class="btn btn-default btn-icon icon-left hidden-print pull-right">
        Print 
        <i class="entypo-print"></i>
    </a>
</center>
<table  class="table table-bordered " id="Timetable">

    <tbody>
    <h2> Time Table of <?php echo $this->crud_model->get_class_name($class_id);  ?></h2>
    <?php
    $subjects = $this->db->get_where('time_table', array(
                'class_id' => $class_id,
                'section_id' => $section_id,
                'exam_id' => $exam_id,
                'year' => $this->db->get_where('settings', array(
                    'type' => 'running_year'
                ))->row()->description
            ))->result_array();

    $first_time = '';
    $second_time = '';
    // echo $row['subject'].'</br>';
    ?>

    <tr>
        <?php
        foreach ($subjects as $row):
            //$date = strtotime($row['date'])
            ?>
            <td colspan="2"><?php echo date('d-M-y', strtotime($row['date'])); ?></td>

            <?php
            $first_time = $row['first_time'];
            $second_time = $row['second_time'];
        endforeach;
        ?> 
    </tr>
    <tr>
        <?php
        for ($i = 0; $i < count($subjects); $i++) {
            ?>
            <td><?php echo $first_time ?></td>
            <td> <?php echo $second_time ?></td>
            <?php
        }
        ?>
    </tr>

    <tr>
        <?php
        foreach ($subjects as $row):
            //$date = strtotime($row['date'])
            ?>
            <td><?php echo $row['first_subject']; ?></td>
            <td><?php echo $row['second_subject']; ?></td>

        <?php endforeach; ?> 

    </tr>

</tbody>
</table>
<br><br>


<script type="text/javascript">

    // print invoice function
    function PrintElem(elem)
    {
        Popup($(elem).html());
    }

    function Popup(data)
    {
        var mywindow = window.open('', 'invoice', 'height=400,width=600');
        mywindow.document.write('<html><head><title>Invoice</title>');
        mywindow.document.write('<link rel="stylesheet" href="assets/css/neon-theme.css" type="text/css" />');
        mywindow.document.write('<link rel="stylesheet" href="assets/js/datatables/responsive/css/datatables.responsive.css" type="text/css" />');
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        setInterval(function () {
            mywindow.document.close();
            mywindow.focus();
            mywindow.print();
            mywindow.close();
        }, 100);

        return true;
    }

</script>

