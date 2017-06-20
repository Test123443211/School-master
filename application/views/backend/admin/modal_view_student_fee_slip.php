<?php
$student_info = $this->db->get_where('student_fee_list', array(
            'id' => $param2
        ))->result_array();
$year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;

$fee_types = $this->db->get('fee_types')->result_array();

foreach ($student_info as $row):
    $student_id = $row['student_id'];
    $class_id = $row['class_id'];

endforeach;
?>
<center>
    <a onClick="PrintElem('#invoice_print')" class="btn btn-default btn-icon icon-left hidden-print pull-right">
        Print List
        <i class="entypo-print"></i>
    </a>
</center>

<div id="invoice_print">
    
    <header class="row">

    <div class="col-sm-6">
        <b>
            <?php echo $this->db->get_where('student', array('student_id' => $student_id))->row()->name; ?>                     
        </b>
S/O 
        <?php
        $parent_id = $this->db->get_where('student', array(
                    'student_id' => $student_id
                ))->row()->parent_id;
        echo $this->db->get_where('parent', array(
            'parent_id' => $parent_id
        ))->row()->name;
        ?>

    </div>

    <div class="col-sm-6">
        Detail   Fee List Session <?php echo $year ?>
        
    </div>


</header>


<table class="table table-bordered datatable" id="table_export">
    <thead>
        <tr>
            <th><div> Sr#</div></th>
            <th><div><?php echo get_phrase('type'); ?></div></th>
            <th><div><?php echo get_phrase('amount'); ?></div></th> 

        </tr>
    </thead>
    <tbody>

        <?php
        $total = 0;
        $count = 1;
        foreach ($fee_types as $rowtypes):
            ?>
            <tr>
                <td><?php
                    echo $count;
                    $count++;
                    ?> </td>

                <td> <?php echo $rowtypes ['name'] ?></td>

                <td> <?php
                    $amount = $this->db->get_where(' student_fee_list', array(
                                'class_id' => $class_id,
                                'student_id' => $student_id,
                                'session' => "$year",
                                'fee_type_id' => $rowtypes['id'],
                            ))->row()->amount;
                    echo $amount;
                    $total +=$amount;
                    ?> 
                </td>
            </tr>
            <?php
        endforeach;
        ?> 
        <tr class="bg-primary">
            <td colspan="2"><b> Total </b></td> 
            <td><?php echo $total ?></td>
        </tr>
    </tbody>
</table>


    
</div>


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