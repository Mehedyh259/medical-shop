<?php 
include('include/header.php'); 
include('include/conn.php'); 
include('include/login_check.php'); 

if (isset($_POST['update'])){
    $name = $_POST['username'];
    $pass = $_POST['password'];
    $email = $_POST['email'];
    $image_name = '';
    
    if(empty($_FILES['picture']['name'])){
        $sql = "update login set username='$name', password='$pass', email='$email' where 1";
    }else{
        $image_name = 'profile_'.$_FILES['picture']['name'];
        $destination = 'assets/img/profile/'.$image_name;
        move_uploaded_file($_FILES['picture']['tmp_name'],$destination);
        
        $sql = "update login set username='$name',email='$email' password='$pass', picture='$image_name' where 1 ";
    }
    $result = mysqli_query($conn,$sql);
    if($result){
        if(!empty($image_name)){
            unlink('assets/img/profile/'.$_SESSION['picture']);
            $_SESSION['picture'] = $image_name;
        }
        $_SESSION['userName'] = $name;
        $_SESSION['password'] = $pass;
        $_SESSION['email']=$email;

        echo "<script>
        alert('Profile Updated Successfully !' );  
        window.location='profile';
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


    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto bg-white mt-5 p-5 rounded">
                <form method="POST" enctype="multipart/form-data" action="">
                    
                    <img src="assets/img/profile/<?php echo $_SESSION['picture']; ?>" class="rounded img-thumbnail mx-auto d-block" alt="..."  width="200px"> <br><br>

                    <div class="form-group row">
                        <label for="userPicture" class="form-label mr-4">Picture </label> <br>
                        <div class="col-sm-10">
                            <input type="file" accept=".png, .jpg, .JPG, .JPEG, .jpeg" name="picture" class="form-control" id="userPicture">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="username" class="form-label">UserName</label> <br>
                        <div class="col-sm-10">
                            <input type="text" name="username"required class="form-control" id="username" placeholder="Username"
                            value="<?php  echo $_SESSION['userName']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="form-label mr-2">Email </label> 
                        <div class="col-sm-10">
                            <input type="text" name="email"required class="form-control ml-4" id="email" placeholder="Email"
                            value="<?php  echo $_SESSION['email']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="form-label mr-1">Password </label> <br>
                        <div class="col-sm-10">
                            <input type="password" minlength="6" maxlength="50" name="password" required class="form-control" id="password" placeholder="Password" 
                            value="<?php  echo $_SESSION['password']; ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-12">
                            <button type="submit" name="update" class="btn btn-block btn-info">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


</section>








<?php include('include/footer.php'); ?>