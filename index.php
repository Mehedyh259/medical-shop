<?php 
include('include/header.php'); 
include('include/conn.php'); 
include('include/login_check.php'); 

if (isset($_POST['addCategory'])){
    $name = strtolower($_POST['catName']);
    $check = mysqli_query($conn,"select * from categories where name = '$name'");

    if(mysqli_num_rows($check) > 0){
        echo "<script>
                alert('Category already exits !');
                window.location('index');
            </script>";
        exit();
    }else{
        $image_name = time().'_'.$_FILES['image']['name'];
        $destination = 'assets/img/'.$image_name;
        move_uploaded_file($_FILES['image']['tmp_name'],$destination);
        
        $result = mysqli_query($conn,"insert into categories (name, picture) values('$name','$image_name')");
        if($result){
            echo "<script>
                alert('Category Added Successfully !');
                window.location('index');
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
    <?php include('include/topbar.php'); 
    
    ?>


    <div class="manage-categories py-2 mt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <span>Categories</span>
                    <a href="" class="btn btn-sm btn-info pull-right" data-toggle="modal" data-target="#addIn"><i
                            class="fa fa-plus"></i> Add category</a>
                    <a href="<?php  echo $base_url.'categories' ?>" class="btn btn-sm btn-info pull-right mr-2"><i
                            class="fa fa-cog"></i> Manage category</a>
                </div>
            </div>
        </div>
        <!--modal for adding category-->

        <div id="addIn" class="modal fade in" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Inventory</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" enctype="multipart/form-data">
                        <div class="modal-body">

                            <div style="width: 77%;margin: auto;">

                                <div class="form-group">
                                    <label for="some" class="col-form-label">Name</label>
                                    <input type="text" name="catName" class="form-control" id="some" required>
                                </div>
                                <div class="form-group">
                                    <label for="2" class="col-form-label">Picture</label>
                                    <input type="file" accept=".png, .jpg, .JPG, .JPEG, .jpeg" name="image" class="form-control" id="2" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-info" name="addCategory">Save Category</button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>



    <!-- Inventory All Item Category View-->

    <div class="category-view mt-2">
        <div class="container-fluid">
            <div class="row">
                <?php  
                $query = mysqli_query($conn,"select * from categories");
                while($row = mysqli_fetch_array($query)){
                    $name = $row['name'];
                    $q = mysqli_query($conn,"SELECT * FROM inventory where itemCategory = '$name' ");
                    $count = mysqli_num_rows($q);
                    ?>
                <div class="col-lg-3 col-md-6">
                    <a href="<?php  echo $base_url.'inventories?key='.base64_encode($row['name']); ?>">
                        <div class="single-category">
                            <div class="card" style="width:100%">
                                <img class="card-img-top img-thumbnail" src="assets/img/<?php echo $row['picture'] ?>"
                                    alt="Card image cap">
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">Name: <span
                                                class="float-right text-capitalize"><?php echo $row['name'] ?></span>
                                        </li>
                                        <li class="list-group-item">Quantity: <span
                                                class="float-right"><?php  echo $count; ?></span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <?php 
                }
                
                ?>





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