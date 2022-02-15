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

if (isset($_POST['updateCategory'])){
    $name = $_POST['catName'];
    $id = $_POST['catId'];
    
    if(empty($_FILES['catImage']['name'])){
        $sql = "update categories set name='$name' where id='$id'";
    }else{
        $image_name = time().'_'.$_FILES['catImage']['name'];
        $destination = 'assets/img/'.$image_name;
        move_uploaded_file($_FILES['catImage']['tmp_name'],$destination);
        
        $sql = "update categories set name='$name', picture='$image_name'  where id='$id'";
    }
    $result = mysqli_query($conn,$sql);
    if($result){
        echo "<script>
                alert('Category Updated Successfully !' );
                
            </script>";
    
    
    }


} 
if (isset($_POST['deleteCategory'])){
    $id = $_POST['catId'];
    
    $sql = "delete from categories where id='$id'";

    $result = mysqli_query($conn,$sql);
    if($result){
        echo "<script>
                alert('Category Deleted Successfully !' );
                window.location('categories');

            </script>";


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
<style>
    .manage-categories{
        margin-top: -16px !important;
    }    
    
    </style>
    <div class="breadcumb-area">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-dashboard"></i><a href="index.php"> Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Manage Categories</li>
            </ol>
        </nav>
    </div>
    <div class="manage-categories py-2">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <span>Categories</span>
                    <a href="" class="btn btn-sm btn-info pull-right"data-toggle="modal" data-target="#addCat"><i class="fa fa-plus"></i> add category</a>

                </div>
            </div>
        </div>
        <div class="pb-3"></div>

        <!--modal for adding category-->

        <div id="addCat" class="modal fade in" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Category</h5>
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
                            <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-sm btn-info" name="addCategory">Save Category</button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
        
        <!--modal for update category-->

        <div id="updateCat" class="modal fade in" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Update This Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" enctype="multipart/form-data">
                        <div class="update-modal-body">

                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-info" name="updateCategory">Update Category</button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
        <!--modal for delete category-->

        <div id="deleteCat" class="modal fade in" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete This Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" enctype="multipart/form-data">
                        <div class="delete-modal-body px-5">
                            

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger" name="deleteCategory">Delete</button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
        
        
        
    </div>
    <div class="table-area">
        <div class="container">
            <div class="row">
                <div class=" col-md-12 mx-auto">
                    <div class="tableBox" >
                        <table id="dataTable" class="table text-center rounded table-bordered table-striped" style="z-index: -1">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Picture</th>
                                    <th>Name</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                               <?php
                                $query = mysqli_query($conn,"select * from categories");
                                $i=1;
                                while($row = mysqli_fetch_array($query)){
                                    ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><img src="<?php echo $base_url.'assets/img/'.$row['picture'] ; ?>" alt="" height="25px" width="25px"></td>
                                    <td><?php echo $row['name']; ?></td>

                                    <td>
                                        
                                        <button class="btn btn-sm btn-info mr-1" id="edit_btn" data-id="<?php echo $row['id']; ?>"><i class="fa fa-edit"></i> Edit</button>

                                        <button class="btn btn-sm btn-danger" id="delete_btn" data-id="<?php echo $row['id']; ?>"><i class="fa fa-trash"></i> Delete</button>
                                    </td>
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


<script type="text/javascript">
    

    $(document).on('click','#edit_btn',function() {
        var ID = $(this).attr('data-id');

        $.ajax(
            {
                url: 'ajax_helpers/category_update.php',
                method: 'POST',
                data:{catID:ID},
                dataType: 'html',
                success: function(data)
                {
                    $('.update-modal-body').html(data);
                    $("#updateCat").modal('show');

                }

            })
    });
    $(document).on('click','#delete_btn',function() {
        var ID = $(this).attr('data-id');

        $.ajax(
            {
                url: 'ajax_helpers/category_delete.php',
                method: 'POST',
                data:{catID:ID},
                dataType: 'html',
                success: function(data)
                {
                    $('.delete-modal-body').html(data);
                    $("#deleteCat").modal('show');

                }

            })
    });

</script>





















