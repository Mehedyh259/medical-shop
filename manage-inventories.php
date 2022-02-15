<?php 
include('include/header.php'); 
include('include/conn.php'); 
include('include/login_check.php'); 


if (isset($_POST['updateItem'])){
    $itemId = $_POST['itemId'];
    $itemName = strtolower($_POST['itemName']);
    $itemGroup = strtolower($_POST['itemGroup']);
    $itemCategory = strtolower($_POST['itemCategory']);
    $itemCompany = strtolower($_POST['itemCompany']);
    $itemUnit = strtolower($_POST['itemUnit']);
    $itemQuantity = $_POST['itemQuantity'];
    $itemPrice = $_POST['itemPrice'];
    $itemDescription = $_POST['itemDescription'];

    $result = mysqli_query($conn,"update inventory set itemName='$itemName',itemGroup='$itemGroup',itemCategory= '$itemCategory',itemCompany='$itemCompany',
    itemUnit='$itemUnit',itemQuantity='$itemQuantity',itemPrice='$itemPrice',itemDescription='$itemDescription' where id='$itemId'");

    
    if($result){
        echo "<script>
                alert('item Updated Successfully !' );
                window.location('manage-inventories');
            </script>";
    }


}
if (isset($_POST['deleteItem'])){
    $id = $_POST['itemId'];
    
    $sql = "delete from inventory where id='$id'";

    $result = mysqli_query($conn,$sql);
    if($result){
        echo "<script>
                alert('Item Deleted Successfully !' );
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

    <div class="breadcumb-area">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-dashboard"></i><a href="index.php"> Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Manage Inventories</li>
            </ol>
        </nav>
    </div>
    
    <!--modal for update item details-->
    
    <div id="updateItem" class="modal fade in" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content p-5">
                <div class="modal-header">
                    <h5 class="modal-title">Update This Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" enctype="multipart/form-data">
                    <div class="update-item-modal">

                        <!-- modal code works here -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info" name="updateItem">Update Item</button>
                    </div>
                </form>


            </div>
        </div>
    </div>
    
    
    
    
    <!--modal for delete item -->

        <div id="deleteItem" class="modal fade in" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete This Item</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" enctype="multipart/form-data">
                        <div class="delete-item-modal px-5">
                            
                        <!-- Modal code works here  -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger" name="deleteItem">Delete</button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    
    
    
    
    
    <!--table area-->
    
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
                                    <th>Category</th>
                                    <th>Company</th>
                                    <th>Unit</th>
                                    <th>Quantity</th>
                                    <th>Price (Tk)</th>
                                    <th>Description</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>

                                <?php  
    
                                    $sql="SELECT * FROM inventory";
                                 

                                    $query = mysqli_query($conn,$sql);
                                    while($row = mysqli_fetch_assoc($query)){
                                    $item = $row['itemCategory'];
                                    $qq = mysqli_query($conn,"select * from categories where name='$item'");
                                    $pic = mysqli_fetch_assoc($qq);
                                ?>
                                <tr class="text-capitalize">

                                <td class="text-center"><img src="assets/img/<?php echo $pic['picture']; ?>" alt="image" 
                                    style="width:50px;height:50px; "></td>
                                    <td><?php echo $row['itemName']  ?></td>
                                    <td><?php echo $row['itemGroup']  ?></td>
                                    <td><?php echo $row['itemCategory']  ?></td>
                                    <td><?php echo $row['itemCompany']  ?></td>
                                    <td><?php echo $row['itemUnit']  ?></td>
                                    
                                    <td><?php  echo $row['itemQuantity'];?></td>
                                    <td><?php echo $row['itemPrice'] ?></td>
                                    <td><?php echo $row['itemDescription'] ?></td>
                                    
                                    
                                    <td>
                                        <ul class="list-inline m-0">
                                            
                                            <li class="list-inline-item">
                                                <button class="btn btn-info btn-sm " type="button" id="update_btn" data-id="<?php echo $row['id']; ?>" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i> </button>
                                            </li>
                                            <li class="list-inline-item">
                                                <button class="btn btn-danger btn-sm " type="button" id="delete_btn" data-id="<?php echo $row['id']; ?>" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-alt"></i> </button>
                                            </li>
                                        </ul>

                                    </td>

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
    

    //update item ajax call

    $(document).on('click','#update_btn',function() {
        var ID = $(this).attr('data-id');

        $.ajax(
            {
                url: 'ajax_helpers/inventory_update.php',
                method: 'POST',
                data:{itemID:ID},
                dataType: 'html',
                success: function(data)
                {
                    $('.update-item-modal').html(data);
                    $("#updateItem").modal('show');

                }

            })
    });

    //delete item ajax call
    
    $(document).on('click','#delete_btn',function() {
        var ID = $(this).attr('data-id');

        $.ajax(
            {
                url: 'ajax_helpers/inventory_delete.php',
                method: 'POST',
                data:{itemID:ID},
                dataType: 'html',
                success: function(data)
                {
                    $('.delete-item-modal').html(data);
                    $("#deleteItem").modal('show');

                }

            })
    });
    
</script>



