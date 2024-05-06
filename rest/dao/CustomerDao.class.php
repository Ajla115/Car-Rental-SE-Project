<?php
require_once __DIR__ . '/BaseDao.class.php';


class CustomerDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct("customers");
    }
    


    // custom function, which is not present in BaseDao, that will return all information of one customer based on its name and lastname
    // query_unique will return only 1 result if multiple are present, but query will return all
    function getCustomerByFirstNameAndLastName($customer_name, $customer_surname)
    {
        return $this->query_unique("SELECT * FROM customers WHERE customer_name = :customer_name AND customer_surname = :customer_surname", ["customer_name" => $customer_name, "customer_surname" => $customer_surname]);
    }


}
?>
