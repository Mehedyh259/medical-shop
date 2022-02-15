

 <div class="col-md-6">
     
 </div>       

<?php
//Include database connection
include('../include/conn.php');


if($_POST['itemID']) {
    $id = $_POST['itemID']; 
    

    $query = mysqli_query($conn,"select * from inventory where id='$id'");
    
    
    
    $row = mysqli_fetch_array($query);
    
   
    $part_one ='<div class="container">
    <div class="row">


<div class="col-md-6">
            <div class="form-group">
            <input type="hidden" name="itemId" class="form-control" value="'.$id.'" required>
                <label for="itemName">Item Name: <span class="text-danger">*</span></label>
                <input type="text" value="'.$row["itemName"].'" class="form-control" id="itemName" placeholder="Enter Item Name" name="itemName">
            </div>
</div> 
<div class="col-md-6">
            <div class="form-group">
                <label for="itemGroup">Item Generic Name:</label>
                <input type="text" value="'.$row["itemGroup"].'" class="form-control" id="itemGroup" placeholder="Enter Item Generic Name" name="itemGroup">
            </div>
</div>
<div class="col-md-6">            
            <div class="form-group">
                <label for="itemCategory"> Select Category:</label>
                <select class="form-control text-capitalize" id="itemCategory" name="itemCategory">
                    <!--all categories-->
                    <option  value="'.$row["itemCategory"].'">'.$row["itemCategory"].'</option>';
    
    
   echo $part_one;
    
            $q= mysqli_query($conn,"select name from categories");
            while($name = mysqli_fetch_array($q)){
                echo '<option value= "'.$name['name'].'">'.$name['name'].'  </option>';
            }  
                    
                    
    $part_two=' 
                </select>
            </div>
</div>
<div class="col-md-6">
            <div class="form-group">
                <label for="itemCompany">Company Name: <span class="text-danger">*</span></label>
                <input type="text" value="'.$row["itemCompany"].'" class="form-control" id="itemCompany" placeholder="Enter Item Company Name" name="itemCompany">
            </div>
</div>
<div class="col-md-6">
            <div class="form-group">
                <label for="itemUnit">Item Mass Unit (Mg or ML): <span class="text-danger">*</span></label>
                <input type="text" value="'.$row["itemUnit"].'" class="form-control" id="itemUnit" placeholder="Enter Item Mass in Mg or ML" name="itemUnit">
            </div>
</div>
    <div class="col-md-6">
            <div class="form-group">
                <label for="itemQuantity">Item Quantity: <span class="text-danger">*</span></label>
                <input type="number" value="'.$row["itemQuantity"].'" class="form-control" id="itemQuantity" value="1" name="itemQuantity">
            </div>
        </div>
    <div class="col-md-6">        
            <div class="form-group">
                <label for="itemPrice">Item Price: <span class="text-danger">*</span></label>
                <input type="number" value="'.$row["itemPrice"].'" class="form-control" id="itemPrice" value="0" name="itemPrice">
            </div>
            </div>
<div class="col-md-6">
            <div class="form-group">
                <label for="itemDescription">Item Description:</label>
                <textarea class="form-control"  id="itemDescription" rows="2" name="itemDescription">'.$row["itemDescription"].'</textarea>
            </div> 
        </div>            
    </div>
</div>
    ';
                

    echo $part_two;


}
?>
