<?php 
include('include/header.php'); 
include('include/conn.php'); 
$email = '';
if(isset($_POST['recovery'])){
    $email = $_POST['email'];
    $q = "select * from login where email='$email'";
    $query=mysqli_query($conn,$q);
    if(mysqli_num_rows($query) == 0){
        echo "<script>
                alert('Invalid mail inserted !');
                window.location('login');
            </script>";

    }else{
        $row = mysqli_fetch_array($query);
        $subject = "Password Recovery Mail";
       // $pass = $row['password'];
        $otp = rand(111111,999999);
        $_SESSION['otp']=$otp;
        
        
        require 'PHPMailer/PHPMailerAutoload.php';
        require 'constants.php';

        
        $mail = new PHPMailer();
        
        $mail->isSMTP();
        $mail->SMTPAuth =true;
        $mail->SMTPSecure='ssl';  //tls ssl
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 465;    // 587 465
        $mail->IsHTML(true);
        $mail->CharSet='UTF-8';
        $mail->Username=MAIL;
        $mail->Password=PASSWORD;
        $mail->SetFrom(MAIL, 'MEDIQAS');
        $mail->AddAddress($email,'');
        $mail->addReplyTo('no-reply@gmail.com', 'No-reply');
        

        $mail->Subject = $subject;
        $mail->Body=" This is the mail from MEDIQAS medical store.<br>
                    Your Recovery Password OTP of MEDIQAS account is:  <b>".$otp."</b>";
        $mail->SMTPOptions = array(
            'ssl' => [
                'verify_peer' => false,
                'verify_depth' => false,
                'allow_self_signed' => false,
                'verify_peer_name' => false
            ]
        );

        if ($mail->send()) {
            $_SESSION['time']= $_SERVER["REQUEST_TIME"];
            $_SESSION['resetMail']=$email;
                      
        } else {

            
             echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
    }   

}


?>




    
   
    <div class="col-md-6 mx-auto p-5 mt-5 rounded bg-secondary">
        <h3 class="text-center p-4 text-white bg-info mb-4 ">OTP VARIFICATION</h3>

        <form action="reset-password" method="POST">
            <div class="form-group">
                
                <input name="otp" type="text" placeholder="Enter OTP Code" class="form-control" required>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-success" name="otpSubmit" value="Submit">
            </div>

            
        </form>
    </div>
    








<?php include('include/footer.php'); ?>
