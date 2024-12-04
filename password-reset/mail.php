<?php
require '../connection.php';

session_start();

$_SESSION['email'] = $_POST['email'];

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//required files
require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';

//Create an instance; passing `true` enables exceptions
if (isset($_POST["send"])) {

    $mail = new PHPMailer(true);

    //Server settings
    $mail->isSMTP();                              //Send using SMTP
    $mail->Host = 'smtp.gmail.com';       //Set the SMTP server to send through
    $mail->SMTPAuth = true;             //Enable SMTP authentication
    $mail->Username = 'rakeshjoshi6078@gmail.com';   //SMTP write your email
    $mail->Password = 'mupbldwdjijxkdtg';      //SMTP password
    $mail->SMTPSecure = 'ssl';            //Enable implicit SSL encryption
    $mail->Port = 465;


    // OPT generate
    function generateOTP($length = 6)
    {
        // Ensure the length is between 4 and 10
        $length = max(4, min($length, 10));

        $otp = '';
        for ($i = 0; $i < $length; $i++) {
            $otp .= mt_rand(0, 9);
        }
        return $otp;
    }

    // Example usage
    $otp = generateOTP(); // Generates a 6-digit OTP
    // echo "Your OTP is: " . $otp;


    //Recipients
    $mail->setFrom('rakeshjoshi6078@gmail.com', 'Mangalam'); // Sender Email and name
    $mail->addAddress($_POST['email']);     //Add a recipient email  
    $mail->addReplyTo('rakeshjoshi6078@gmail.com', 'Mangalam'); // reply to sender email

    //Content
    $mail->isHTML(true);               //Set email format to HTML
    $mail->Subject = "Password reset code!";   // email subject headings
    $mail->Body = "Your password reset code is:<br>" . $otp . "<br> Please don't share this code to anyone!"; //email message

    // Success sent message alert
    $mail->send();

    $_SESSION['code'] = $otp;

    $email = $_POST['email'];

    $selectEmail = "SELECT * FROM users WHERE email = '$email'";
    $selectEmailResult = mysqli_query($conn, $selectEmail);

    $emailResult = mysqli_fetch_assoc($selectEmailResult);

    $user_id = $emailResult['user_id'];

    $_SESSION['user_id'] = $user_id;

    $insertCode = "INSERT INTO password_resets (user_id, otp, expiry_time) VALUES ('$user_id', '$otp', NOW() + INTERVAL 10 MINUTE)";
    $insertCodeResult = mysqli_query($conn, $insertCode);

    echo
        " 
        // <div class='alert alert-success alert-dismissible fade show' role='alert'>
        //     <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        //      Code sent in your mail.
        // </div>

    <script> 
     document.location.href = 'recover-code.php';
    </script>
    ";
}
?>