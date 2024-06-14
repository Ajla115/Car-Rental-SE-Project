<?php
require_once 'BaseService.php';
require_once __DIR__ . "/../dao/CustomerDao.class.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

use Firebase\JWT\JWT;

class CustomerService extends BaseService
{
    public function __construct()
    {
        parent::__construct(new CustomerDao);
    }


    /* public function update($entity, $id, $id_column="id"){
         $entity['password'] = md5($entity['password']);
         if(isset($entity['id_column']) && !is_null($entity['id_column'])){
             return parent::update($entity, $id, $entity['id_column']);
         }
         return parent::update($entity, $id);
     }*/



    public function update($entity, $id, $id_column = "id")
    {
        $entity['password'] = md5($entity['password']);
        if (isset($id_column) && !is_null($id_column)) {
            return parent::update($entity, $id, $id_column);
        }
        return parent::update($entity, $id);
    }

    public function getAllAdmins(){
        return Flight::customerDao()->getAllAdmins();
    }



    public function add($entity)
    {
        //extract individual attributes from JSON object
        $customer_name = $entity['customer_name'];
        $customer_surname = $entity['customer_surname'];
        $email = $entity['email'];
        $password = $entity['password'];


        if (empty($customer_name) || empty($customer_surname) || empty($password) || empty($email)) {
            return array("status" => 400, "message" => "All fields are required.");

        }

        // Validate customer name and surname to only include letters and dashes
        if (!preg_match('/^[a-zA-Z-]+$/', $customer_name)) {
            return ["status" => 400, "message" => "Name should only contain letters and dashes."];
        }


        if (!preg_match('/^[a-zA-Z-]+$/', $customer_surname)) {
            return ["status" => 400, "message" => "Surname should only contain letters and dashes."];
        }


        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return ["status" => 400, "message" => "E-mail address is not in the right format"];
        }

        // Check if the email is in the admin format
        if (preg_match('/^.+@admin\.gmail\.com$/i', $email)) {
            return ["status" => 400, "message" => "Only an admin can register other admins. You can't register yourself with this email."];
        }

        if (mb_strlen($password) < 8) {
            return ["status" => 400, "message" => "The password should not be shorter than 8 characters."];
        }

        if (mb_strlen($password) > 15) {
            return ["status" => 400, "message" => "The password should not be longer than 15 characters."];
        }




        //Password was hashed using a modern bcrypt algorithm
        $password = $entity['password'];
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $entity['password'] = $hashedPassword;
        $newCustomer = parent::add($entity);

        
        return array("customer" => $newCustomer);

    }

    public function addAdmin($entity)
    {
        //extract individual attributes from JSON object
        $customer_name = $entity['customer_name'];
        $customer_surname = $entity['customer_surname'];
        $email = $entity['email'];
        $password = $entity['password'];


        if (empty($customer_name) || empty($customer_surname) || empty($password) || empty($email)) {
            return array("status" => 400, "message" => "All fields are required.");

        }

        // Validate customer name and surname to only include letters and dashes
        if (!preg_match('/^[a-zA-Z-]+$/', $customer_name)) {
            return ["status" => 400, "message" => "Name should only contain letters and dashes."];
        }


        if (!preg_match('/^[a-zA-Z-]+$/', $customer_surname)) {
            return ["status" => 400, "message" => "Surname should only contain letters and dashes."];
        }


        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return ["status" => 400, "message" => "E-mail address is not in the right format"];
        }

        if (!preg_match('/^.+@admin\.gmail\.com$/i', $email)) {
            return ["status" => 400, "message" => "Admin email must be in the form @admin.gmail.com."];
        }

        if (mb_strlen($password) < 8) {
            return ["status" => 400, "message" => "The password should not be shorter than 8 characters."];
        }

        if (mb_strlen($password) > 15) {
            return ["status" => 400, "message" => "The password should not be longer than 15 characters."];
        }

        //Password was hashed using a modern bcrypt algorithm
        $password = $entity['password'];
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $entity['password'] = $hashedPassword;
        $newCustomer = parent::add($entity);

        
        return array("customer" => $newCustomer);

    }

    public function checkExistenceForEmail($email)
    {
        $emailExistence = Flight::customerDao()->checkExistenceForEmail($email);
        return $emailExistence;
    }

    public function login($data)
    {

        $email = $data['email'];
        $password = $data['password'];

        if (empty($email) || empty($password)) {
            //return array("status" => 500, "message" => "Field is empty.");
            Flight::halt(500, "Empty fields. Fill them.");
        }

        // Check if the email actually exists
        $user = $this->checkExistenceForEmail($email);
        if (!$user || !password_verify($password, $user['password'])) {
            // User not found, indicate that the email does not exist
            //return array("status" => 500, "message" => "Invalid credentials.");

            Flight::halt(500, "Invalid credentials.");
        }

        unset($user['password']);

        $issue_time = time(); // issued at
        $expiration_time = $issue_time + 3600; // expires after one hour
    
        // Add issue time and expiration time to the user data
        $user['iat'] = $issue_time;
        $user['exp'] = $expiration_time;

        $jwt = JWT::encode($user, Config::JWT_SECRET(), 'HS256');

        // If all checks pass, proceed with login or token generation etc.
        // Assuming login success at this point and you might generate a token or session
        return ["jwt" => $jwt];
    }


    function getCustomerByFirstNameAndLastName($customer_name, $customer_surname)
    {
        return $this->dao->getCustomerByFirstNameAndLastName($customer_name, $customer_surname);
    }

    public function customUpdate($data)
    {
        return $this->dao->customUpdate($data);
    }

    public function delete($id)
    {
        try {
            $this->dao->delete($id);
        } catch (Exception $e) {
            throw new Exception('Error deleting customer: ' . $e->getMessage());
        }
    }

    public function resetpassword($data){
        $email = $data["email"];
        $password = $data["password"];
        $confirm_password = $data["confirm_password"];

        if (!isset($email) || !isset($password) || !isset($confirm_password)) {
            Flight::halt(500, "Fields cannot be empty.");
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return ["status" => 400, "message" => "E-mail address is not in the right format"];
        }

        if (!($this->checkExistenceForEmail($data["email"]))) {
            Flight::halt(500, "Email does not exist.");
        }

        //check if the new and repeated password are the same
        if (!hash_equals($password, $confirm_password)) {
            Flight::halt(500, "New and repeated password are not the same.");
        }

        //now check if the new password  fits the criteria
        if (mb_strlen($password) < 8) {
            Flight::halt(500, "The password should be at least 8 characters long");
        }

        if (mb_strlen($password) > 15) {
            return ["status" => 400, "message" => "The password should not be longer than 15 characters."];
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $daoResult = $this->updatePassword($hashedPassword, $email);

        if ($daoResult["status"] == 500) {
            Flight::halt(500, $daoResult["message"]);
        } 
        return $daoResult;
    }

    private function updatePassword($password, $email)
    {
        $result = Flight::customerDao()->updatePassword($password, $email);
        return $result;
    }

    public function sendEmail($data)
    {
        $subject = $data["subject"];
        $body = $data["body"];
        $email = $data["email"];
        $recipientName = $data["name"];
        $mail = new PHPMailer(true);
        try {
            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER; //Enable verbose debug output
            $mail->SMTPDebug = SMTP::DEBUG_OFF; //Enable verbose debug output
            //ovo debug off sam stavila da nemam onaj ogromni output, sta se desava u svakoj sekundi slanja emaila

            $mail->isSMTP(); //Send using SMTP
            $mail->Host = 'smtp.eu.mailgun.org'; //Set the SMTP server to send through
            $mail->SMTPAuth = true; //Enable SMTP authentication
            $mail->Username = 'postmaster@dr-korman-ajla.tech'; //SMTP username
            $mail->Password = '8f9103ee36c42bd4797841ece2c3da3b-ed54d65c-dcdb0b29'; //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            //$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
            $mail->Port = 587;
            //465, TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //port 587 mi ovdje nije radio iako mi je bilo preporuceno da njega stavim
            //Recipients
            $mail->setFrom('ajla.korman@stu.ibu.edu.ba', 'Car Rental SE Project');
            $mail->addAddress($email, $recipientName); //Add a recipient
            //Content
            $mail->isHTML(true); //Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            $mail->send();
            return array("status" => 200, "message"=>"Email is sent!");
        } catch (Exception $e) {
            error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}\n");
            //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    

}





