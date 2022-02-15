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
    <?php include('include/topbar.php')  ?>
    
    <div class="breadcumb-area">
    <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-dashboard"></i><a href="index"> Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">All Items</li>
                <?php  
                    if(isset($_GET['key'])){
                        $ct =  base64_decode($_GET['key']);
                        echo '<li class="breadcrumb-item active text-capitalize" aria-current="page">'.$ct.'</li>';
                    } ?>
                <li class="float-right">
                    <a href="billing" class="btn btn-info text-white ml-5 ">
                        <i class="fas fa-shopping-cart"></i> <span id="counter" class="badge badge-light">
                            <?php
                            if(isset($_SESSION['cart'])){
                                echo sizeof($_SESSION['cart']);
                            }else{
                                echo '0';
                            }

                            ?>
                        </span>
                     </a>
                     <a href='cart/clear.php?url=<?php echo $_SERVER['PHP_SELF']; ?>'><button class=" ml-1 btn btn-outline-danger btn">clear</button></a>
                </li>
            </ol>

        </nav>
        
    </div>
    <div class="table-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="tableBox" >
                        <table id="dataTable" class="table table-bordered table-striped" style="z-index: -1">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Generic Name</th>
                                <th>Unit</th>
                                <th>Price per unit</th>
                                <th>Quantity</th>
                                <th>Company</th>
                                <th>Type</th>
                                <th></th>
                                
                            </tr>
                        </thead>
                        <tbody>
                           
                    <?php  
                        if(isset($_GET['key'])){
                            $ct = base64_decode($_GET['key']);
                            $sql = "SELECT * FROM inventory WHERE itemCategory = '$ct'";
                        }else{
                            $sql="SELECT * FROM inventory";
                        }
                       
                        $query = mysqli_query($conn,$sql);
                        while($row = mysqli_fetch_assoc($query)){
                            $item = $row['itemCategory'];
                            $qq = mysqli_query($conn,"select * from categories where name='$item'");
                            $pic = mysqli_fetch_assoc($qq);
                            ?>
                            <tr class="text-capitalize">

                               <form action="cart/manage_cart.php" method="POST">
                                    <td class="text-center"><img src="assets/img/<?php echo $pic['picture']; ?>" alt="image" 
                                    style="width:50px;height:50px; "></td>
                                    <td><?php echo $row['itemName']  ?></td>
                                    <td><?php echo $row['itemGroup']  ?></td>
                                    <td><?php echo $row['itemUnit']  ?></td>
                                    <td><?php echo $row['itemPrice'].' tk' ?></td>
                                    <td><?php 
                                        
                                    if($row['itemQuantity'] == 0)
                                        echo '<span class="text-danger">out of stock</span>';
                                    else
                                        echo $row['itemQuantity'];
                                        
                                        ?></td>
                                    <td><?php echo $row['itemCompany']  ?></td>
                                    <td><?php echo $row['itemCategory']  ?></td>
                                     <td>
                                     <?php 
                                            if($row['itemQuantity'] != 0)
                                                echo '<button type="submit" name="addToCart" class="btn btn-sm btn-info">select</button>'  ;
                                        ?> 
                                        <input type="hidden" name="id" value="<?php echo $row['id'];  ?>"> 
                                        <input type="hidden" name="Item_Name" value="<?php echo $row['itemName'];  ?>"> 
                                        <input type="hidden" name="Item_Unit" value="<?php echo $row['itemUnit'];  ?>">
                                        <input type="hidden" name="Price" value="<?php echo $row['itemPrice'];  ?>"> 
                                        <input type="hidden" name="ItemQuantity" value="<?php echo $row['itemQuantity'];  ?>">          
                                        <input type="hidden" name="Image" value="<?php echo $pic['picture']  ?>">          
                                
                                    </td>
                               </form>

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







<?php include('include/footer.php'); ?>
