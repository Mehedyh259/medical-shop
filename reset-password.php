<?php 
include('include/header.php'); 
include('include/conn.php'); 

$matched = false;

if(isset($_POST['otpSubmit'])){
    $time = $_SERVER["REQUEST_TIME"];
    if(($time - $_SESSION['time']) > 300){
        echo "<script>
                alert('OTP Time Expired. Please Try Again !' );
                window.location.href='login';
                exit();
            </script>";
          
            exit();
    }else{
        if($_POST['otp']==$_SESSION['otp']){
             $matched = true;
             
         }
    }
    
}


if(isset($_POST['resetPass'])){
    $pass = $_POST['password'];
    $email = $_SESSION['resetMail'];

        $query = mysqli_query($conn,"update login set password = '$pass' where email = '$email'");
        if($query){
            unset($_SESSION['otp']);
            unset($_SESSION['time']);
            unset($_SESSION['resetMail']);
            
            echo "<script>
                alert('Password Reset Successfull   !' );
                window.location.href='login';
                exit();
            </script>";
        }
    }


?>



   
    <div class="col-md-6 mx-auto p-5 mt-5 rounded bg-secondary">
        <?php 
            if($matched == true){
               
                ?>

                <h3 class="text-center bg-info p-4 mb-4 text-white">RESET LOGIN PASSWORD</h3>
            <form action="reset-password.php" method="POST">
                <div class="form-group">
                    <input name="password" type="text" minlength="6" placeholder="Create Password" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <input type="submit" class="btn btn-success" name="resetPass" value="Reset Password">
                </div>

                
            </form>

                <?php
            }else{?>

                <h3 class="text-center bg-danger text-white pb-3">Otp Not Matched</h3>

            <?php }
        ?>
    </div>
    








<?php include('include/footer.php'); ?>
