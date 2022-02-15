<?php 
include('include/header.php'); 
include('include/conn.php'); 
include('include/login_check.php'); 


if (isset($_POST['addItem'])){
    $itemName = strtolower($_POST['itemName']);
    $itemGroup = strtolower($_POST['itemGroup']);
    $itemCategory = strtolower($_POST['itemCategory']);
    $itemCompany = strtolower($_POST['itemCompany']);
    $itemUnit = strtolower($_POST['itemUnit']);
    $itemQuantity = $_POST['itemQuantity'];
    $itemPrice = $_POST['itemPrice'];
    $itemDescription = $_POST['itemDescription'];
    
    $q = mysqli_query($conn,"select * from inventory where itemName = '$itemName' and itemUnit = '$itemUnit' ");
    if(mysqli_num_rows($q) == 0){
        $query = mysqli_query($conn,"insert into inventory (itemName,itemGroup,itemCategory,itemCompany,itemUnit,itemQuantity,itemPrice,itemDescription) 
            values('$itemName','$itemGroup','$itemCategory','$itemCompany','$itemUnit','$itemQuantity','$itemPrice','$itemDescription')");

        if($query){
            echo "<script>
                alert('Item Added Successfully !');
                window.location('add-item');
            </script>";
        }
    }else{
        $query = mysqli_query($conn,"update inventory set itemQuantity = itemQuantity + '$itemQuantity' where itemName = '$itemName' and itemUnit = '$itemUnit'");
        if($query){
            echo "<script>
                alert('Item Quantity Increased !');
                window.location('add-item');
            </script>";
        }
    }
    
    
    


}


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
                <li class="breadcrumb-item"><i class="fa fa-dashboard"></i><a href="index.php"> Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Item</li>
            </ol>
        </nav>
    </div>
    
    <!--Item adding form-->
    
    <div class="item-form p-5 bg-white col-md-10 mx-auto">
        <form action="add-item.php" method="POST">
           
            
           <div class="conatiner">
               <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="itemName">Item Name: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="itemName" placeholder="Enter Item Name" name="itemName" required>
                         </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="itemGroup">Item Generic Name:</label>
                        <input type="text" class="form-control" id="itemGroup" placeholder="Enter Item Generic Name" name="itemGroup" required>
                    </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="itemCategory"> Select Category:</label>
                        <select class="form-control text-capitalize" id="itemCategory" name="itemCategory">
                            <?php 
                            $query = mysqli_query($conn,"select * from categories");
                            while($result = mysqli_fetch_assoc($query)){
                            ?>
                            <!--all categories-->
                            <option  value="<?php echo $result['name'] ?>"><?php echo $result['name'] ?></option>

                            <?php } ?>
                        </select>
                    </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="itemCompany">Company Name: <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="itemCompany" placeholder="Enter Item Company Name" name="itemCompany" required>
                    </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="itemUnit">Item Mass Unit (Mg or ML): <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="itemUnit" required placeholder="Enter Item Mass in Mg or ML" name="itemUnit">
                    </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="itemQuantity">Item Quantity: <span class="text-danger">*</span></label>
                        <input type="number" min="1" class="form-control" id="itemQuantity" required value="1" name="itemQuantity">
                    </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="itemPrice">Item Price: <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="itemPrice" required min="0" name="itemPrice">
                    </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="itemDescription">Item Description:</label>
                        <textarea class="form-control" id="itemDescription" rows="2" name="itemDescription"></textarea>
                    </div> 
                    </div>
                       </div>
                   </div>

            <button type="submit" name="addItem" class="btn btn-success"> Add Item </button>
        </form>
    </div>
    


</section>








<?php include('include/footer.php'); ?>