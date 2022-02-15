<?php
//Include database connection
include('../include/conn.php');


if($_POST['catID']) {
    $id = $_POST['catID']; 

    $query = mysqli_query($conn,"select * from categories where id='$id'");
    $row = mysqli_fetch_assoc($query);
    $result = '<h3>You are deleting <b class="text-danger">'.ucfirst($row['name']).'</b></h3> <br><input type="hidden" name="catId" class="form-control" value="'.$row["id"].'" >';
    
    echo $result;
    echo "Are you sure to delete ?"; 

}
?>
