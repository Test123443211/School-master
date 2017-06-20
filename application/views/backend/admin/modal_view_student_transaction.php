<?php
$student_id = $this->db->get_where('student_transaction', array(
            'id' => $param2
        ))->row()->student_id;


$class_id = $this->db->get_where('student_transaction', array(
            'id' => $param2
        ))->row()->class_id;


$year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;


$payment_info = $this->db->get_where('student_transaction', array(
            'class_id' => $class_id,
            'student_id=' => $student_id,
            'session' => $year,
        ))->result_array();
?>


<center>
    <a onClick="PrintElem('#invoice_print')" class="btn btn-default btn-icon icon-left hidden-print pull-right">
        Print  Payment  Detail 
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
        Payment  Detail  List Session <?php echo $year ?>
    </div>


</header>


<table class="table table-bordered datatable" id="table_export">
    <thead>
        <tr>
            <th><div> Sr#</div></th>
            <th><div><?php echo get_phrase('payment'); ?></div></th>
            <th><div><?php echo get_phrase('due_date'); ?></div></th> 
            <th><div><?php echo get_phrase('checked_by'); ?></div></th>
            <th><div><?php echo get_phrase('created_by'); ?></div></th>
            <th><div><?php echo get_phrase('remarks'); ?></div></th>
            <th class="invisible-print"><div><?php echo get_phrase('action'); ?></div></th>

        </tr>
    </thead>
    <tbody>

        <?php
        $total = 0;
        $count = 1;
        foreach ($payment_info as $payment):
            ?>
            <tr>
                <td> <?php
                    echo $count;
                    $count++;
                    ?> </td>

                <td> <?php
                    echo $payment ['payment'];
                    $total +=$payment ['payment'];
                    ?>         </td>

                <td> <?php echo date("d-M-Y", strtotime($payment ['due_date'])) ?>       </td>
                <td> <?php echo $payment['checked_by'] ?>       </td>
                <td> <?php echo $payment['created_by'] ?>       </td>
                <td> <?php echo $payment['remarks'] ?>       </td> 

                <td class="invisible-print">
                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                            Action <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-default pull-right" role="menu">
 
                            <!-- EDITING LINK -->
                            <li>
                                <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modal_edit_student_transaction/<?php echo $payment['id']; ?>');">
                                    <i class="entypo-pencil"></i>
                                    <?php echo get_phrase('edit'); ?>
                                </a>
                            </li>
                            <li class="divider"></li>

                            <!-- DELETION LINK -->
                            <li>
                                <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>index.php?admin/student_transaction/delete/<?php echo $payment['id']; ?>');">
                                    <i class="entypo-trash"></i>
                                    <?php echo get_phrase('delete'); ?>
                                </a>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
            <?php
        endforeach;
        ?> 
        <tr class="bg-primary">
            <td colspan="4"><b> Total </b></td> 
            <td colspan="3"><?php echo $total ?></td>
        </tr>
    </tbody>
</table>

    <style type="text/css">
      
            @media print{
                  .invisible-print{
                      display: none;
            }
        }
        
        </style>

    
    
</div>



<script type="text/javascript">

    // print invoice function
    function PrintElem(elem)
    {
        Popup($(elem).html());
    }

    function Popup(data)
    {
        var mywindow = window.open('', 'Student Transaction', 'height=400,width=600');
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