<?php
require_once 'BaseService.php';
require_once __DIR__ . "/../dao/CustomerDao.class.php";

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

        //password does not go in to the token
        unset($entity['password']);

        //Generate the JWT token
        $jwt = JWT::encode($entity, Config::JWT_SECRET(), 'HS256');

        // Return the JWT token in the response
        return array("token" => $jwt, "customer" => $newCustomer);

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

    public function delete($id) {
        try {
            $this->dao->delete($id);
        } catch (Exception $e) {
            throw new Exception('Error deleting customer: ' . $e->getMessage());
        }
    }
    



}
