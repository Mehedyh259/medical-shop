<?php 
include('include/header.php'); 
include('include/conn.php'); 
include('include/login_check.php'); 





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
                <li class="breadcrumb-item"><i class="fa fa-dashboard"></i><a href="index.php"> Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Billing</li>
                
            </ol>
        </nav>
    </div>

        <div class="billing-area p-3 ">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 text-center border rounded bg-light my-2">
                    <h1 class="py-2">BILLING PAGE</h1>
                </div>

                <div class="bg-light col-md-9 mx-auto">
                    <table class="table table-bordered text-center">
                        <thead>
                            <th>Sl No.</th>
                            <th>Item Image</th>
                            <th>Item Name</th>
                            <th>Item Unit</th>
                            <th>Item Price (Tk)</th>
                            <th>Quantity</th>
                            <th>SubTotal</th>
                            <th></th>
                        </thead>
                        <tbody>
                            <?php
                            if(isset($_SESSION['cart'])){
                                $count=1;
                               
                                foreach ($_SESSION['cart'] as $key => $value) {

                                    echo ' 
                                    <tr>
                                        <td>'.$count++.'</td>
                                        <td class="text-center">
                                            <img src="assets/img/'.$value["Image"].'" alt="image" 
                                             style="width:40px;height:35px; ">
                                        </td>
                                        <td class="text-capitalize">'.$value["Item_Name"].'</td>
                                        <td>'.$value["Item_Unit"].'</td>
                                        <td >'.$value["Price"].'<input type="hidden" class="iprice" value="'.$value["Price"].'"></td>
                                        <td>
                                        <form action="cart/manage_cart.php" method="POST">
                                            <input onChange="this.form.submit()" onPaste="this.form.submit()" name="Mod_Quantity"
                                             style="width: 100px; display: inline-block" 
                                            class="iquantity form-control text-center" type="number"value="'.$value["Quantity"].'" 
                                            min="1" max="'.$value["ItemQuantity"].'">
                                            <input type="hidden" name="Item_Name" value="'.$value["Item_Name"].'">
                                            <input type="hidden" name="Item_Unit" value="'.$value["Item_Unit"].'">
                                         </form>

                                            <span> (max: '.$value["ItemQuantity"].') </span>
                                        </td>
                                        <td class="itotal"></td>

                                        <td>
                                            <form action="cart/manage_cart.php" method="POST">
                                                <input type="hidden" name="Item_Name" value="'.$value["Item_Name"].'">
                                                <input type="hidden" name="Item_Unit" value="'.$value["Item_Unit"].'">
                                                <button name="Remove_Item" class="btn btn-sm btn-outline-danger">remove</button>

                                            </form>
                                        </td>
                                    </tr>

                                    ';
                                }
                            }


                            ?>
                          <tr style="font-size: 20px;" class="bg-info text-white font-weight-bold">
                            <td colspan="6">Total Payment =</td>
                            <td id="gtotal">0</td> 
                            <td>TK</td>
                         </tr> 
                            
                            
                        </tbody>
                    </table>
                </div>
                <div class="col-md-3">
                    <div class="bg-light border p-3 rounded">
                        <?php
                        if(isset($_SESSION['cart']) && count($_SESSION['cart'])>0)
                        { 
                        ?>
                        <form action="invoice.php" method="POST">
                            <div class="form-group">
                                <input type="text" name="customerName" required="" class="form-control" placeholder="Enter Customer Name">   
                            </div>
                            <div class="form-group">
                                <input type="text" name="customerAddress" required="" class="form-control" placeholder="Enter Customer Address">   
                            </div>

                            <div class="from-group">
                                <input type="number" name="customerPhone" class="form-control" placeholder="Enter Customer Number">
                            </div>
                            <div class="form-group">
                                <label class="mt-2" for="payment">Choose Payment Type:</label>
                                <select class="form-control" id="payment" name="paymentType">
                                    <option value="cash">Cash Payment</option>
                                    <option value="bkash">Bkash Payment</option>
                                </select> 
                            </div>
                            
                            
                            <button name="purchase" type="submit" class="btn purchase mt-5 btn-success btn-block" > Make Purchase</button>
                        </form>
                        <?php 
                    }
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

</section>




<?php include('include/footer.php');?>

<script>

    var  iquantity = document.getElementsByClassName('iquantity');
    var  iprice = document.getElementsByClassName('iprice');
    var  itotal= document.getElementsByClassName('itotal');
    var  gtotal=document.getElementById('gtotal');
    var gt =0;
    function subTotal(){
        gt =0;
        for(i=0; i < iprice.length;i++){
            itotal[i].innerText = (iprice[i].value)*(iquantity[i].value);
            gt = gt + ((iprice[i].value)*(iquantity[i].value));
        }
        gtotal.innerText=gt;
    }
    subTotal();





    // $( document ).ready(function() {    

    //     $(document).on("input paste change keyup", ".quantity", function( event ) {         
    //         var product_quantity = 0;
    //         var price = 0;
    //         var sub_total = 0;
    //         var grand_total = 0
    //         product_quantity = $(this).val();
    //         price = $(this).parent().prev().html();
    //         sub_total = price * product_quantity;
    //         $(this).parent().next().html(sub_total);
    //         $('.quantity').each( function( k, v ) {
    //             product_quantity = parseInt ( $(this).val() ) ? parseInt ( $(this).val() ) : 0;
    //             price = parseFloat($(this).parent().prev().html())?parseFloat($(this).parent().prev().html()):0;          
    //             sub_total = parseFloat ( price * product_quantity );
    //             grand_total += sub_total;

    //         });       
    //         $("#total").html(grand_total);         
          
    //     });
        
    
    // });
</script>