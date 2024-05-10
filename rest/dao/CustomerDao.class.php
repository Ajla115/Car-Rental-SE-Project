<?php
require_once __DIR__ . '/BaseDao.class.php';


class CustomerDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct("customers");
    }


    public function checkExistenceForEmail($email)
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM customers WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            return $user; // I am returning the whole object here
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }



    // custom function, which is not present in BaseDao, that will return all information of one customer based on its name and lastname
    // query_unique will return only 1 result if multiple are present, but query will return all
    function getCustomerByFirstNameAndLastName($customer_name, $customer_surname)
    {
        return $this->query_unique("SELECT * FROM customers WHERE customer_name = :customer_name AND customer_surname = :customer_surname", ["customer_name" => $customer_name, "customer_surname" => $customer_surname]);
    }

    public function customUpdate($data)
    {
        try {
            // Prepare an SQL statement to update the customers table
            $stmt = $this->conn->prepare("UPDATE customers SET customer_name = :customer_name, customer_surname = :customer_surname, email = :email WHERE id = :id");

            // Bind parameters to the prepared statement
            $stmt->bindParam(':customer_name', $data['customer_name']);
            $stmt->bindParam(':customer_surname', $data['customer_surname']);
            $stmt->bindParam(':email', $data['email']);
            $stmt->bindParam(':id', $data['id']);

            // Execute the prepared statement
            $stmt->execute();

            // Check if any row was actually updated
            if ($stmt->rowCount() > 0) {
                return "Update successful!";
            } else {
                return "No changes made or customer not found.";
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

}


