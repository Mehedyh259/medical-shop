<?php 
include('include/header.php'); 
include('include/conn.php'); 
include('include/login_check.php'); 
$customerName='';
$customerPhone='';
$customerAddress='';
$paymentType='';
$grandTotal=0;
$date = date("Y/m/d");

//counting total ammount
if(isset($_SESSION['cart'])){
	foreach ($_SESSION['cart'] as $key => $value) {
		$grandTotal += ($value['Price'] * $value['Quantity']);
	}
}

if(isset($_POST['purchase'])){
	$customerName= $_POST['customerName'];
	$customerAddress=$_POST['customerAddress'];
	$customerPhone=$_POST['customerPhone'];
	$paymentType=$_POST['paymentType'];
	$invoiceNo = insertInvoice($customerName,$grandTotal,$date);

	if(isset($_SESSION['cart'])){
		foreach ($_SESSION['cart'] as $key => $value) {
			$item_name=$value['Item_Name'];
			$item_unit=$value['Item_Unit'];
			$item_quantity=$value['Quantity'];
			$item_price = $value['Price'];
			$total = $item_price * $item_quantity;

            updateQuantity($value['ItemId'],$item_quantity);

			insertReport($invoiceNo,$item_name,$item_unit,$item_quantity,$item_price,$total,$customerName,$customerPhone,$customerAddress,$date);
		}
	}
	
}
function updateQuantity($id, $quantity){
    global $conn;
    $query = mysqli_query($conn,"update inventory set itemQuantity = (itemQuantity - '$quantity') where id = '$id'");
}
 function insertInvoice($name,$total,$date){
 	global $conn;
	$query= mysqli_query($conn,"insert into invoices (customer_name,total_amount,date) values 
		('$name','$total','$date')");
	if($query){
		$q = mysqli_query($conn,"select * from invoices order by id desc limit 1");
		$row = mysqli_fetch_assoc($q);
		return $row['id'];
	}
}

function insertReport($invoiceNo,$item_name,$item_unit,$item_quantity,$item_price,$total,$customerName,$customerPhone,$customerAddress,$date){
	global $conn;
	$sql ="insert into sells_report (invoice_no,item_name,item_unit,item_quantity,item_price,total,
			customer_name,customer_phone,customer_address,date) 
			values
			('$invoiceNo','$item_name','$item_unit','$item_quantity','$item_price','$total',
			'$customerName','$customerPhone','$customerAddress','$date')";
	$query=mysqli_query($conn,$sql);

}




?>


<!--sidebar html-->
<section class="sidebar-area">
    <?php include('include/sidebar.php') ?>
</section>

<!--body area-->
<section class="content-area">
    <?php include('include/topbar.php'); 
    
    ?>
    <style>
        td{
            padding: 7px 2px !important;
        }
    </style>

    <div class="breadcumb-area">
    <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-dashboard"></i><a href="index"> Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">All Items</li>
                
                <li class="float-right">
                    <button id="print-btn" class="btn btn-info text-white ml-5 "><i class="fa fa-print" aria-hidden="true"></i> Print Bill</button>
                    
                </li>
            </ol>

        </nav>
        
    </div>

 	<section class="invoice-area">	
 		<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card " id="invoice-card">
                <div class="card-body p-0">
                    <div class="row p-5">
                        <div class="col-md-6">
                            <img src="assets/img/mediqas.jpg" height="120px" width="460px">
                            <h3 class="pl-2">Medical Store</h3>
                        </div>

                        <div class="col-md-6 text-right">
                            <p class="font-weight-bold mb-1">Invoice No #<?php echo $invoiceNo; ?></p>
                            <p class="text-muted mt-2">Date & Time: <?php echo date("d-m-Y h:i A"); ?></p>
                            
                        </div>
                    </div>

                    <hr class="my-5">

                    <div class="row pb-5 p-5">
                        <div class="col-md-6">
                            <p class="font-weight-bold mb-4">Customer Information</p>
                            <p class="mb-1"><?php echo $customerName  ?></p>
                            <p class="mb-1"><?php echo $customerAddress ?></p>
                             <p>Phone: <?php echo $customerPhone  ?></p>
                        </div>

                        <div class="col-md-6 text-right">
                            <p class="font-weight-bold mb-4">Payment Details</p>
                            <p class="mb-1"><span class="text-muted">Payment Type: </span> <?php echo $paymentType  ?></p>
                            <p class="mb-1"><span class="text-muted">Name: </span> <?php echo $customerName  ?></p>
                        </div>
                    </div>

                    <div class="row p-5">
                        <div class="col-md-12">
                            <table class="table text-center">
                                <thead>
                                    <tr>
                                        <th class="border-0 text-uppercase small font-weight-bold">Sl.</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Item Name</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Item Unit</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Price (Tk)</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Quantity</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Sub Total(Tk)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php
                            if(isset($_SESSION['cart'])){
                                $count=1;
                               	$subTotal=0;
                                foreach ($_SESSION['cart'] as $key => $value) {	
                                	$subTotal=$value['Price'] * $value['Quantity'];
                                   echo '
                                   <tr>
                                        <td> '.$count++.' </td>
                                        <td> '.$value['Item_Name'].' </td>
                                        <td> '.$value['Item_Unit'].' </td>
                                        <td> '.$value['Price'].' </td>
                                        <td>'. $value['Quantity'].' </td>
                                        <td>'. $subTotal.' </td>
                                        

                                    </tr>

                                   ' ;

                                    }
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="d-flex flex-row-reverse  font-weight-bold p-4">
                        <div class="pb-5 px-5 text-right">
                            <div class="mb-2">Grand Total</div>
                            <div class="h2"><?php echo $grandTotal; ?>.00 <span>Tk</span></div>
                        </div>

                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    

</div>
 	</section>



    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

</section>




<?php include('include/footer.php');?>


<script type="text/javascript">
	
	$(document).ready(function(){
		function printData(){
			var mywindow = window.open('','PRINT PAGE','height=650,width=850');

			mywindow.document.write('<html><head>');
			mywindow.document.write('<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">');
			mywindow.document.write('</head><body >');
			mywindow.document.write(document.getElementById('invoice-card').innerHTML);
			mywindow.document.write('</body></html>');


			setTimeout(function () {
			    mywindow.print();
			    mywindow.close();
			}, 500);
			return true;
		}		
		$("#print-btn").click(function(){
			printData();
		});
	});
</script>