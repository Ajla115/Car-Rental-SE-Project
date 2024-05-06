<?php
require_once __DIR__ . '/BaseDao.class.php';


class EmployeeDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct("employees");  
        //name of the table in DB is written with lower-case letter, so I wrote it like that in every class
    }


    
}
?>
