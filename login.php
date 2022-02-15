<?php
    
    include('include/conn.php');
    include('include/header.php');

if(isset($_SESSION['userName'])){
    header( "location:".$base_url);
    exit();
}


if (isset($_POST['login'])) 
{
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $error = '';
    

    $result = mysqli_query($conn,"SELECT * FROM login WHERE email='$user' OR username='$user'  AND password='$pass'");
    if(mysqli_num_rows($result)>0)
    {	
        session_start();
        $data = mysqli_fetch_array($result);
        $_SESSION['userId']=$data['id'];
        $_SESSION['email']=$data['email'];
        $_SESSION['userName']=$data['username'];
        $_SESSION['password']=$data['password'];
        $_SESSION['picture']=$data['picture'];
       
        
        
        if(!empty($_POST['remember'])){
            $cookie_name= $user;
            $cookie_pass = $pass;    
        }else{
            $cookie_name= '';
            $cookie_pass = '';  
        }

        setcookie('name', $cookie_name, time() + (86400 * 30)); //one months
        setcookie('pass', $cookie_pass, time() + (86400 * 30)); //one months
        
        header( "location:".$base_url);
    }
    else
    {
       $error = 'Login Error! Try again.';
    }
}


?>


<!-- the modal -->
<div class="modal" id="recoveryModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Recovery Password</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <form action="otp-check" method="POST" class="py-2">
                <label for="email">Enter Recovery Mail:</label><br>
                <input class="form-control" type="email" id="email" placeholder="Enter Your mail to recover" name="email"><br>
    
                <input class="btn btn-sm btn-success" type="submit" id="recovery" name="recovery" value="Send OTP email">
            </form>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
  
</div>





<section class="banner-area-start" style="background: url('assets/img/banner.jpg');background-position: center;background-size: cover;background-repeat: no-repeat;">
    <div class="banner-content">
        <form  class="box" action="" method="POST">
            <h1>Login</h1>
            <p class="text-muted"> Please enter your Username and Password!</p> 
            <input type="text" name="username" placeholder="Username or Email" value="<?php if(!empty($_COOKIE['name'])) echo $_COOKIE['name']; ?>">
             
            <input type="password" id="password" name="password" placeholder="Password"value="<?php if(!empty($_COOKIE['pass'])){ echo $_COOKIE['pass'];}  ?>">
            
            <span class="pass-show"><i class="fa fa-eye-slash show-btn"></i></span>
             
            <label for="remember-me" class="text-info">
            <span><input id="remember-me" name="remember" type="checkbox" <?php if(isset($_COOKIE['name'])) echo 'checked'; ?> ></span><span class="text-white"> Remember me</span> </label><br>
            
            <p><a href='#' data-toggle="modal" data-target="#recoveryModal">Forgot password ?</a></p>

            <input type="submit" name="login" value="Login" >
            <div class="alert alert-danger" id="error"  style="width: 80%;margin: auto; <?php if(empty($error)){echo 'display:none;';}  ?>  "> <?php  echo $error;  ?></div>
            

        </form>
    </div>
</section>



<?php  include('include/footer.php')  ?>









