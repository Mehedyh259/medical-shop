<?php
//Include database connection
include('../include/conn.php');


if($_POST['itemID']) {
    $id = $_POST['itemID']; 

    $query = mysqli_query($conn,"select * from inventory where id='$id'");
    $row = mysqli_fetch_assoc($query);
    $result = '<h3> You are deleting <b class="text-danger">'.ucfirst($row['itemName']).' ('.$row['itemUnit'].')</h3></b><br><input type="hidden" name="itemId" class="form-control" value="'.$row["id"].'" >';
    
    echo $result;
    echo "Are you sure to delete ?"; 

}
?>