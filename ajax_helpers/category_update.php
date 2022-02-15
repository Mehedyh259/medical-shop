<?php
//Include database connection
include('../include/conn.php');


if($_POST['catID']) {
    $id = $_POST['catID']; 

    $query = mysqli_query($conn,"select * from categories where id='$id'");
    $row = mysqli_fetch_assoc($query);
    $result = '
    
                <div style="width: 77%;margin: auto;">

                    <div class="form-group">
                        <label for="some" class="col-form-label">Name</label>
                        <input type="text" name="catName" class="form-control" id="catName" value="'.$row["name"].'" required>
                        <input type="hidden" name="catId" class="form-control" value="'.$row["id"].'" required>
                    </div>
                    <div class="form-group">
                        <img class=" img-thumbnail" src="'.$base_url.'/assets/img/'.$row["picture"] .'" alt="" height="100px" width="90px"><br>
                        <label for="image" class="col-form-label">Picture</label>
                        <input type="file" accept=".png, .jpg, .JPG, .JPEG, .jpeg" name="catImage" class="form-control" id="image" >
                    </div>
                </div>
    
    
    ';


    
    
    
    echo $result;


}
?>
