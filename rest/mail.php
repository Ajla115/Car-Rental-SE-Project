<?php
//in order for the email to start, you have to enable option "Less secure apps" on your gmail account

    use PHPMailer\PHPMailer\PHPMailer;

    

    if (isset($_POST['name']) && isset($_POST['email'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $body = $_POST['body'];

        require_once "PHPMailer/PHPMailer.php";
        require_once "PHPMailer/SMTP.php";
        require_once "PHPMailer/Exception.php";

        $mail = new PHPMailer();

        //SMTP Settings
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = "sender@gmail"; //sender email
        $mail->Password = '******'; //enter the password here
        $mail->Port = 465; //587
        $mail->SMTPSecure = "ssl"; //tls

        //Email Settings
        $mail->isHTML(true);
        $mail->setFrom($email, $name);
        $mail->addAddress("recipient@gmail"); //recipient email
        $mail->Subject = $subject;
        $mail->Body = $body;

        if ($mail->send()) {
            
           $status = "success";
            $response = "Email is sent!";
           //header('Location: http://localhost/WebProjectPart2/index2.html');
        } else {
            $status = "failed";
            $response = "Something is wrong: <br><br>" . $mail->ErrorInfo;
        }

        exit(json_encode(array("status" => $status, "response" => $response)));
    }
?>
