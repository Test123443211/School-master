
<div class="row">
    <div class="col-md-12">

        <br/>

        <br/>
        <?php
        //   SELECT sum(amount) as invisment, 
        //   Month(FROM_UNIXTIME(timestamp)) as monthh from payment 
        //   where year="2016-2017" GROUP by Month(FROM_UNIXTIME(timestamp))

        $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $this->db->select('sum(amount) as amount, Month(FROM_UNIXTIME(timestamp)) as month ');
        $this->db->from('payment');
        $this->db->group_by('Month(FROM_UNIXTIME(timestamp))');
        $this->db->where(array(
            'payment_type' => 'expense',
            'year' => "$year"
        ));
        $expenses = $this->db->get()->result_array();
        ?>
        <span class="pull-right">
            <a onClick="PrintElem('#printelement')" class="btn btn-default btn-icon icon-left hidden-print pull-right">
                Print  Payment  Detail 
                <i class="entypo-print"></i>
            </a>
        </span>
        <hr/>
        <div class="row" id="printelement">

            <style type="text/css">
                td{
                    padding: 1px !important;
                }
                th{
                    padding: 1px !important;
                }
            </style>

            <div class="col-xs-6">
                <div class="panel panel-primary">
                    <div class=" panel-heading text-center text-capitalize">
                        <h3 class="panel-title">
                            Expense of Session  " <?php echo $year ?> "
                        </h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-condensed table-bordered text-center" style="font-size: 10px !important">
                            <tr class="bg-primary bold">
                                <td> Sr# </td>
                                <td> Month </td>
                                <td> Expenses </td>
                            </tr>
                            <?php
                            $count = 0;
                            $total_expesnes = 0;
                            foreach ($expenses as $row) {
                                ?>
                                <tr>
                                    <td> <?php echo ++$count; ?>  </td>
                                    <td><?php echo date('F', mktime(0, 0, 0, $row['month'], 10)); ?>   </td>
                                    <td> <?php
                                        echo $row['amount'];
                                        $total_expesnes +=$row['amount'];
                                        ?>   </td>
                                </tr>
                                <?php
                            }
                            ?>
                            <tr class="bg-primary bold">
                                <td colspan="2"> Total Expenses</td>
                                <td> <?php echo $total_expesnes; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>

            </div>


            <?php
            //SELECT MONTHNAME(due_date) AS month_name, sum(payment) as payment FROM `student_transaction` GROUP by MONTH(due_date)
            $this->db->select('sum(payment) as payment, MONTHNAME(due_date) AS month_name ');
            $this->db->from('student_transaction');
            $this->db->group_by('MONTH(due_date)');
            $this->db->where(array(
                'session' => "$year"
            ));
            $income = $this->db->get()->result_array();
            ?>

            <div class="col-xs-6">
                <div class="panel panel-primary">
                    <div class=" panel-heading text-center text-capitalize">
                        <h3 class="panel-title">
                            Income of Session  " <?php echo $year ?> "
                        </h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-condensed table-bordered text-center" style="font-size: 10px !important">
                            <tr class="bg-primary bold">
                                <td> Sr# </td>
                                <td> Month </td>
                                <td> Income </td>
                            </tr>
                            <?php
                            $countt = 0;
                            $total_income = 0;
                            foreach ($income as $row) {
                                ?>
                                <tr>
                                    <td> <?php echo ++$countt; ?>  </td>
                                    <td><?php echo $row['month_name']; ?>   </td>
                                    <td> <?php
                                        echo $row['payment'];
                                        $total_income +=$row['payment'];
                                        ?>   </td>
                                </tr>
                                <?php
                            }
                            ?>
                            <tr class="bg-primary bold">
                                <td colspan="2"> Total Income</td>
                                <td> <?php echo $total_income; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-sm-offset-4 col-xs-6 col-xs-offset-3">
                <div class="panel panel-primary">
                    <div class=" panel-heading text-center text-capitalize">
                        <h3 class="panel-title">
                            Summery of Session  " <?php echo $year ?> "
                        </h3>
                    </div>
                    <div class="panel-body">

                        <table class="table table-condensed table-bordered text-center" style="font-size: 10px !important">
                            <tr class="bold">
                                <td> Total Income</td>
                                <td> <?php echo $total_income; ?> </td> 
                            </tr>

                            <tr class="bold">
                                <td> Total Expenses</td>
                                <td> <?php echo $total_expesnes; ?> </td> 
                            </tr>

                            <tr class="bold bg-primary">
                                <td> <?php echo $total_income > $total_expesnes ? "Profit" : "Lose"; ?></td>
                                <td> <?php echo abs($total_income - $total_expesnes); ?> </td> 
                            </tr>


                        </table>

                        <div class="text-center bold">
                            Percentage  =  <?php echo round((100 * ($total_income - $total_expesnes)) / $total_income, 2) . " %  " ?>
                            <button type="button" class="btn btn-default btn-lg">
                                <?php
                                echo $total_income > $total_expesnes ?
                                        '<span class="glyphicon glyphicon-circle-arrow-up" aria-hidden="true"></span>' :
                                        '<span class="glyphicon glyphicon-circle-arrow-down" aria-hidden="true"></span>';
                                ?>


                            </button> 
                        </div>  
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script type="text/javascript">
        jQuery(document).ready(function ($)
        {


            var datatable = $(".example").dataTable({
                "sPaginationType": "bootstrap",
            });

            $(".dataTables_wrapper select").select2({
                minimumResultsForSearch: -1
            });
        });
    </script>


    <script type="text/javascript">
        // print invoice function
        function PrintElem(elem)
        {
//           
            Popup($(elem).html());
        }

        function Popup(data)
        {
             var mywindow = window.open('', 'Income <?php echo date("d_m_y") . " Session :" . $year ?>', 'height=400,width=600');
            mywindow.document.write('<html><head><title>Income <?php echo date("d_m_y") . " Session :" . $year ?></title>');

            mywindow.document.write('<link rel="stylesheet" href="assets/css/bootstrap.css" type="text/css" />');
            mywindow.document.write('<link rel="stylesheet" href="assets/css/neon-theme.css" type="text/css" />');
            mywindow.document.write('<link rel="stylesheet" href="assets/css/neon-forms.css" type="text/css" />');
            mywindow.document.write('<link rel="stylesheet" href="assets/js/datatables/responsive/css/datatables.responsive.css" type="text/css" />');
            mywindow.document.write('</head><body> <h5 class="text-center"> <b>Income File</b>  &nbsp; &nbsp; print on  <?php echo date("d-m-y") ?></h5>');
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