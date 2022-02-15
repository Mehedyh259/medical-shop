<?php 
include('include/header.php'); 
include('include/conn.php'); 
include('include/login_check.php'); 

?>


<!--sidebar html-->
<section class="sidebar-area">
    <?php include('include/sidebar.php') ?>
</section>
<style>
    button.dt-button, button.dt-button:hover {
    background-color: #357CA5 !important;
    color: #fff;
}
</style>
<!--body area-->
<section class="content-area">
    
    
    <div class="breadcumb-area">
    <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-dashboard"></i><a href="index"> Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Sells Report</li>
            </ol>
        </nav>
    </div>
    <div class="table-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="tableBox" >

                        <table class="mb-2" border="0" cellspacing="5" cellpadding="5">
                            <tbody><tr style="margin-bottom: 3px;">
                                <td>Minimum date: &nbsp;</td>
                                <td><input class="form-control" type="text" id="min" name="min" placeholder="YYYY/MM/DD"></td>
                                <td>&nbsp; Maximum date: &nbsp;</td>
                                <td><input class="form-control" type="text" id="max" name="max" placeholder="YYYY/MM/DD"></></td>
                                <td><a href="sells-report" class="ml-3 btn btn-sm btn-danger">Clear Filter</a></td>
                            </tr>
                            
                        </tbody></table>

                        <table id="dataTable" class="table text-center table-bordered " style="z-index: -1">
                        <thead class="bg-info text-white">
                            <tr>
                                <th>Invoice No.</th>
                                <th>Item Name</th>
                                <th>Item Unit</th>
                                <th>Quantity</th>
                                <th>Item Price (Tk)</th>
                                <th>Total (Tk)</th>
                                <th>Date</th>
                                <th>Customer Name</th>
                                <th>Phone</th>
                                <th>Address</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                    <?php  
                        $query = mysqli_query($conn,"select * from sells_report order by id desc");
                        while($row = mysqli_fetch_assoc($query)){
                            ?>
                            <tr class="text-capitalize">

                                <td ><?php echo $row['invoice_no']  ?></td>
                                <td><?php echo $row['item_name']  ?></td>
                                <td><?php echo $row['item_unit']  ?></td>
                                <td><?php echo $row['item_quantity']  ?></td>
                                <td><?php echo $row['item_price'] ?></td>
                                <td><?php echo $row['total'] ?></td>
                                <td><?php echo $row['date'] ?></td>
                                <td><?php echo $row['customer_name'] ?></td>
                                <td><?php echo $row['customer_phone'] ?></td>
                                <td><?php echo $row['customer_address'] ?></td>
                                
                            </tr>
                            <?php 
                            }

                            ?>

                        </tbody>
                        <tfoot>
                            
                        </tfoot>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    
</section>



<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdn.datatables.net/datetime/1.1.1/js/dataTables.dateTime.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>

<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>


<script>
    var minDate, maxDate;
 
    // Custom filtering function which will search data in column four between two values
    
     $.fn.dataTable.ext.search.push(
        function( settings, data, dataIndex ) {
            var min = minDate.val();
            var max = maxDate.val();
            var date = new Date( data[6] );
     
            if (
                ( min == null && max == null ) ||
                ( min == null && date <= max ) ||
                ( min <= date && max == null ) ||
                ( min <= date && date <= max )
            ) {
                return true;
            }
            return false;
        }
    );
    $(document).ready(function() {
            
        // Create date inputs
        minDate = new DateTime($('#min'), {
            format: 'YYYY/MM/DD'
        });
        maxDate = new DateTime($('#max'), {
            format: 'YYYY/MM/DD'
        });
     
        // DataTables initialisation
        var table = 
                $('#dataTable').DataTable( {
                dom: 'Bfrtip',
                "aaSorting": [[ 0, "desc" ]],
                buttons: [
                    'excel','pdf', 'print'
                ]
            } );
            
        // Refilter the table
       
        $('#min, #max').on('change', function () {
            table.draw();
        });

    });


</script>


























