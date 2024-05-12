<?php

include './config.php';
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
        $mail->Username = EMAIL; //found in the config.php
        $mail->Password = PASSWORD; //found in the config.php
        $mail->Port = 465; //587
        $mail->SMTPSecure = "ssl"; //tls

        //Email Settings
        $mail->isHTML(true);
        $mail->setFrom($email, $name);
        $mail->addAddress(EMAIL2); ////found in the config.php
        $mail->Subject = $subject;
        $mail->Body = $body;

        if ($mail->send()) {
            $response = ["status" => "success", "response" => "Email is sent!"];
            header('Content-Type: application/json');
            echo json_encode($response);
            exit();
        }

        if ($mail->send()) {
            $response = ["status" => "success", "response" => "Email is sent!"];
            header('Content-Type: application/json');
            echo json_encode($response);
            exit();
        }
        else {
            $response = ["status" => "failed", "response" => "Something is wrong: " . $mail->ErrorInfo];
            header('Content-Type: application/json');
            echo json_encode($response);
            exit();
        }
        
        

        // if ($mail->send()) {
            
        //    $status = "success";
        //     $response = "Email is sent!";
        //     header('Location: http://127.0.0.1/Car-Rental-SE-Project/index2.html#index22');
        // } else {
        //     $status = "failed";
        //     $response = "Something is wrong: <br><br>" . $mail->ErrorInfo;
        // }

        // exit(json_encode(array("status" => $status, "response" => $response)));
    }

